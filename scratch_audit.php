<?php
$tables = Illuminate\Support\Facades\Schema::getTables();
$report = [
    'missing_foreign_keys' => [],
    'missing_indexes' => [],
    'foreign_keys' => []
];

foreach ($tables as $tableInfo) {
    $table = $tableInfo['name'];
    if (in_array($table, ['migrations', 'sqlite_sequence', 'sessions', 'cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs', 'personal_access_tokens'])) continue;

    $columns = Illuminate\Support\Facades\Schema::getColumns($table);
    $foreignKeys = Illuminate\Support\Facades\Schema::getForeignKeys($table);
    $indexes = Illuminate\Support\Facades\Schema::getIndexes($table);

    foreach ($foreignKeys as $fk) {
        $report['foreign_keys'][] = [
            'table' => $table,
            'columns' => $fk['columns'],
            'foreign_table' => $fk['foreign_table'],
            'foreign_columns' => $fk['foreign_columns'],
            'on_delete' => $fk['on_delete']
        ];
    }

    foreach ($columns as $column) {
        $colName = $column['name'];
        
        // 1. Missing Foreign Key Check
        if (preg_match('/_id$/', $colName) && $colName !== 'id') {
            $hasFk = false;
            foreach ($foreignKeys as $fk) {
                if (in_array($colName, $fk['columns'])) {
                    $hasFk = true;
                    break;
                }
            }
            if (!$hasFk) {
                $report['missing_foreign_keys'][] = "$table.$colName";
            }
        }

        // 2. Missing Index for foreign keys or lookup fields
        if (preg_match('/_id$/', $colName) || in_array($colName, ['status', 'email', 'slug', 'invoice_number', 'reference_number'])) {
            $hasIndex = false;
            foreach ($indexes as $index) {
                if (in_array($colName, $index['columns'])) {
                    $hasIndex = true;
                    break;
                }
            }
            if (!$hasIndex && $colName !== 'id') {
                $report['missing_indexes'][] = "$table.$colName";
            }
        }
    }
}

file_put_contents('audit_result.json', json_encode($report, JSON_PRETTY_PRINT));
echo "Audit complete.\n";

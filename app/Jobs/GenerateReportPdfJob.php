<?php

namespace App\Jobs;

use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateReportPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $storeId,
        public string $type,
        public ?string $date,
        public $storeModel
    ) {}

    public function handle(ReportService $reportService): void
    {
        $report = $reportService->generateReport($this->storeId, $this->type, $this->date);

        $pdf = Pdf::loadView('reports.pdf', [
            'report' => $report,
            'store' => $this->storeModel,
        ]);

        $pdf->setPaper('a4', 'portrait');

        $filename = 'laporan-' . $this->type . '-' . ($this->date ?: now()->format('Y-m-d')) . '-' . time() . '.pdf';
        
        Storage::disk('public')->put('reports/' . $filename, $pdf->output());
    }
}

import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#5D4037',
                    dark: '#3E2723',
                    light: '#77574d',
                    container: '#ffdbd0',
                },
                secondary: {
                    DEFAULT: '#715a3f',
                    container: '#fadab8',
                },
                tertiary: {
                    DEFAULT: '#504538',
                    container: '#f1e0cd',
                },
                surface: {
                    DEFAULT: '#fdf9f5',
                    dim: '#ddd9d6',
                    bright: '#fdf9f5',
                    container: '#f1ede9',
                    'container-high': '#ebe7e4',
                    'container-highest': '#e6e2de',
                    variant: '#e6e2de',
                    white: '#FFFFFF',
                },
                outline: {
                    DEFAULT: '#E6D5C3',
                    dark: '#A68B6D',
                    variant: '#d4c3be',
                },
                accent: {
                    teal: '#0092AC',
                },
                'on-surface': '#1c1c19',
                'on-surface-variant': '#504441',
                'text-primary': '#3E2723',
                error: {
                    DEFAULT: '#ba1a1a',
                    container: '#ffdad6',
                },
                cream: '#F5F1ED',

                // ── Premium Redesign Palette ──
                terracotta: {
                    DEFAULT: '#A0522D',
                    dark: '#7A3B1E',
                    light: '#C4764A',
                },
                forest: {
                    DEFAULT: '#2E8B57',
                    dark: '#1E6B42',
                    light: '#4CAF7A',
                },
                prada: {
                    DEFAULT: '#D4AF37',
                    light: '#E8CC6E',
                    dark: '#B8951E',
                },
                basalt: {
                    DEFAULT: '#1A1A1A',
                    light: '#2D2D2D',
                    muted: '#4A4A4A',
                },
                'cream-premium': '#FDFBF7',
            },
            fontFamily: {
                display: ['Space Grotesk', ...defaultTheme.fontFamily.sans],
                playfair: ['Playfair Display', 'Georgia', 'serif'],
                body: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'display-lg': ['48px', { lineHeight: '1.1', letterSpacing: '-0.02em', fontWeight: '700' }],
                'display-xl': ['64px', { lineHeight: '1.05', letterSpacing: '-0.03em', fontWeight: '700' }],
                'display-2xl': ['80px', { lineHeight: '1.0', letterSpacing: '-0.03em', fontWeight: '700' }],
                'headline-lg': ['32px', { lineHeight: '1.2', fontWeight: '600' }],
                'headline-md': ['24px', { lineHeight: '1.3', fontWeight: '600' }],
                'headline-sm': ['20px', { lineHeight: '1.3', fontWeight: '600' }],
                'body-lg': ['18px', { lineHeight: '1.6', fontWeight: '400' }],
                'body-md': ['16px', { lineHeight: '1.6', fontWeight: '400' }],
                'body-sm': ['14px', { lineHeight: '1.5', fontWeight: '400' }],
                'label-lg': ['16px', { lineHeight: '1', letterSpacing: '0.04em', fontWeight: '600' }],
                'label-md': ['12px', { lineHeight: '1', letterSpacing: '0.05em', fontWeight: '600' }],
                'label-sm': ['11px', { lineHeight: '1', letterSpacing: '0.06em', fontWeight: '600' }],
                'title-md': ['18px', { lineHeight: '1.3', fontWeight: '600' }],
                'title-sm': ['16px', { lineHeight: '1.3', fontWeight: '600' }],
            },
            borderRadius: {
                DEFAULT: '0.375rem',
                'heritage': '0.375rem',
            },
            spacing: {
                'unit': '8px',
                'gutter': '24px',
                'card-padding': '24px',
                'sidebar': '280px',
            },
            maxWidth: {
                'container': '1440px',
            },
            boxShadow: {
                'card': '0 4px 12px rgba(62, 39, 35, 0.05)',
                'card-hover': '0 12px 32px rgba(62, 39, 35, 0.10)',
                'dropdown': '0 8px 24px rgba(62, 39, 35, 0.10)',
                'premium': '0 20px 60px rgba(26, 26, 26, 0.08)',
            },
            keyframes: {
                'fade-up': {
                    '0%': { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'fade-in': {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
            },
            animation: {
                'fade-up': 'fade-up 0.8s ease-out forwards',
                'fade-up-delay': 'fade-up 0.8s ease-out 0.2s forwards',
                'fade-up-delay-2': 'fade-up 0.8s ease-out 0.4s forwards',
                'fade-in': 'fade-in 1s ease-out forwards',
                'fade-in-slow': 'fade-in 2s ease-out forwards',
            },
        },
    },

    plugins: [forms],
};

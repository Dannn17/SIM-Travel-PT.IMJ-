import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // Tambahkan baris di bawah ini jika kamu meletakkan file komponen Tailwick di dalam resources/js
        './resources/js/**/*.vnode', 
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // --- TAMBAHAN UNTUK TAILWICK ---
            spacing: {
                'header': '70px', // Mengatasi error 'spacing.header' does not exist
                'vertical-menu': '250px', // Biasanya dibutuhkan juga oleh Tailwick
                'vertical-menu-md': '160px',
                'vertical-menu-sm': '70px',
            },
        },
    },

    plugins: [forms, typography],
};
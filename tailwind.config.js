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
            typography: ({ theme }) => ({ // Tambahkan bagian typography ini
                DEFAULT: {
                    css: {
                        p: {
                            textIndent: '1.5em', // Atur indentasi baris pertama (misal 1.5em atau 24px)
                        },
                        
                        'h1, h2, h3, h4, h5, h6': {
                          marginTop: theme('spacing.12'),
                          marginBottom: theme('spacing.4'),
                        },
                    },
                },
                // Jika Anda menggunakan dark mode dengan prose-invert, Anda juga bisa mengkustomisasi di sini:
                // invert: {
                //    css: {
                //        p: {
                //            textIndent: '1.5em',
                //        },
                //    },
                // },
            }),
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'),], 
};

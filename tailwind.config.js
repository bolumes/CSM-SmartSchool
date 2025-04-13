/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.{html,js,php,vue}", // Certifica-se de que o Tailwind vai aplicar os estilos nos arquivos corretos
    ],
    theme: {
        extend: {
            // Você pode adicionar customizações aqui para o seu tema, caso necessário
        },
    },
    plugins: [
        // Aqui você pode adicionar plugins do Tailwind, como forms, typography, etc.
    ],
};

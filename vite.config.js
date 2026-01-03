import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/main.css",
                "resources/js/app.js",
                "resources/css/admin-auth.css",
                "resources/js/admin-auth.js",
                "resources/css/admin-layout.css",
                "resources/js/admin-layout.js",
                "resources/css/registrant-detail.css",
            ],
            refresh: true,
        }),
    ],
    server: {
        cors: true,
    },
});

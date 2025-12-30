import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",

                // ADD THESE TWO LINES:
                "resources/css/admin-auth.css",
                "resources/js/admin-auth.js",

                // ADD THESE FOR ADMIN DASHBOARD:
                "resources/css/admin-layout.css",
                "resources/js/admin-layout.js",
            ],
            refresh: true,
        }),
    ],
    server: {
        cors: true,
    },
});

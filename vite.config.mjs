import { dirname, resolve } from "node:path";
import { fileURLToPath } from "node:url";
import { defineConfig } from "vite";

const __dirname = dirname(fileURLToPath(import.meta.url));

export default defineConfig(({ command }) => ({
    base: command === "serve" ? "http://127.0.0.1:5173/" : "./",
    server: {
        host: "127.0.0.1",
        port: 5173,
        strictPort: true,
        cors: true,
    },
    build: {
        outDir: "dist",
        emptyOutDir: true,
        rolldownOptions: {
            input: {
                style: resolve(__dirname, "src/scss/main.scss"),
                theme: resolve(__dirname, "src/js/main.js"),
            },
            output: {
                entryFileNames: "[name].js",
                assetFileNames: (asset) =>
                    asset.name?.endsWith(".css")
                        ? "theme.css"
                        : "assets/[name][extname]",
            },
        },
    },
}));

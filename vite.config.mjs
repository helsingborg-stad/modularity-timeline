import { createViteConfig } from "vite-config-factory";

const entries = {
        'css/modularity-timeline':               './source/sass/modularity-timeline.scss',
        'js/modularity-timeline':                './source/js/modularity-timeline.js',
};

export default createViteConfig(entries, {
	outDir: "assets/dist",
	manifestFile: "manifest.json",
});

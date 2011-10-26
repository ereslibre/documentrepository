CSS = $(wildcard *.css)

minifyCSS: $(CSS)
	yui-compressor -o '.css$$:-min.css' $(CSS)

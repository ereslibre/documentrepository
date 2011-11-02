CSS = $(wildcard *.css)

minifyCSS: $(CSS)
	yuicompressor -o '.css$$:-min.css' $(CSS)

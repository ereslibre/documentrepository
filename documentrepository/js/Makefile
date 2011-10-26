JS = $(wildcard *.js)

minifyJS: $(JS)
	yui-compressor -o '.js$$:-min.js' $(JS)

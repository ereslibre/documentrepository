JS = $(wildcard *.js)

minifyJS: $(JS)
	yuicompressor -o '.js$$:-min.js' $(JS)

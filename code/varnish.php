# aptitude install libncurses5-dev libpcre3-dev pkg-config make 

Which will pull the C compiler if it is not already installed.

Then, download the source:

# wget http://repo.varnish-cache.org/source/varnish-3.0.3.tar.gz

Extract the source from the archive

# tar xzf varnish-3.0.3.tar.gz

Change the directory to what you just extracted

# cd varnish-3.0.3

Run the configure tool. Make sure there are no errors.

# ./configure

Build the binaries

# make

And install the source.

# make install

# varnishd -F -f /usr/local/etc/varnish/default.vcl

# nano /usr/local/etc/varnish/default.vcl

backend default {
      .host = "127.0.0.1";
      .port = "80";
}

varnishd -f /usr/local/etc/varnish/default.vcl -s malloc,1G -T 127.0.0.1:2000 -a 0.0.0.0:6082

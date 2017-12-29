vcl 4.0;

import std;

# Default port
backend default {
    .host = "nginx";
    .port = "80";
}


# List of hosts authorized to purge request/
acl local {
  "localhost";
  "php-fpm";
}

sub vcl_recv {
  if (req.method == "PURGE") {
    if (client.ip ~ local) {
       return(purge);
    } else {
       return(synth(403, "Access denied."));
    }
  }
}

# Used in order to check the ports used.
sub vcl_recv {
    if (req.http.X-Forwarded-Proto == "https" ) {
        set req.http.X-Forwarded-Port = "443";
    } else {
        set req.http.X-Forwarded-Port = "80";
    }
}

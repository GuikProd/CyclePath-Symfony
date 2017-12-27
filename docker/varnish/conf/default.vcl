vcl 4.0;

# Default port
backend default {
    .host = "nginx";
    .port = "80";
}


# List of hosts authorized to send BAN request/
acl ban {
  "localhost";
  "php-fpm";
}

# Used in order to check the ports used.
sub vcl_recv {
    if (req.http.X-Forwarded-Proto == "https" ) {
        set req.http.X-Forwarded-Port = "443";
    } else {
        set req.http.X-Forwarded-Port = "80";
    }
}

# Check if the backend is healthy, if it is, it can be fetched.
sub vcl_hit {
  if (obj.ttl >= 0s) {
    # Normal hit
    return (deliver);
  } elsif (std.healthy(req.backend_hint)) {
    # The backend is healthy
    # Fetch the object from the backend
    return (fetch);
  } else {
    # No fresh object and the backend is not healthy
    if (obj.ttl + obj.grace > 0s) {
      # Deliver graced object
      # Automatically triggers a background fetch
      return (deliver);
    } else {
      # No valid object to deliver
      # No healthy backend to handle request
      # Return error
      return (synth(503, "Nginx is down"));
    }
  }
}

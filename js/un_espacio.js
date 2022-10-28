
    function un_espacio( e) {
        var limpia = e.value;
        limpia = limpia.toUpperCase().replace(/ {1,}/g, ' ');
        e.value = limpia;
    };

    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        var M = today.getMonth();
        var Y = today.getFullYear();
        var d = today.getDate();
        m = checkTime(m);
        s = checkTime(s);
        M = checkMonth(M);
        $('p#time span').html(h + ":" + m + ":" + s);
        $('p#time date').html(d + " / " + M + " / " + Y);
        setTimeout(startTime, 500);
    }

    function checkMonth(j) {
        month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for (i = 0; i < 12; i++) {
            if (j == i) {
                M = month[i];
            }
        }
        return M;
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
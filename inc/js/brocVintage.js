// Flags in user form select

function change() {

    select = document.getElementById("international_code");
    select_s = select.style;

    switch(select.selectedIndex) {

        case 0 :
            select_s.background = "url(inc/img/CH.png); no-repeat; width:23px; height:17px;";
            break;

        case 1 :
            select_s.background = "url(inc/img/FR.png); no-repeat; width:23px; height:17px;";
            break;

        case 2 :
            select_s.background = "url(inc/img/BE.png); no-repeat; width:23px; height:17px";
            break;

        case 3 :
            select_s.background = "inc/img/DE.png); no-repeat; width:23px; height:17px;";
            break;

        default:
            select_s.background = "none";
            break;
    }
}
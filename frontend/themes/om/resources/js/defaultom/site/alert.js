function getAlertTpl(importance_message, body) {
    str_tpl = "";
    str_tpl += "<div id=\""+importance_message+"\" class=\"alert-sys-"+importance_message+" alert fade in\">";
    str_tpl += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×<\/button>";
    str_tpl += body;
    str_tpl += "<\/div>";

    return str_tpl;
}
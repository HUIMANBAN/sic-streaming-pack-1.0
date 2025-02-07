
function setPauseInfo() {
    tpl = getQuery("tpl")

    if (tpl.length == 0) {
        return
    }
    document.getElementsByClassName("pause-title")[0].textContent = window.settings["pause"][tpl]["title"]
    document.getElementsByClassName("pause-description-html")[0].innerHTML = window.settings["pause"][tpl]["description_html"]
}


setPauseInfo()
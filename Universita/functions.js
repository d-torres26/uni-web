function showbtns() {
    document.getElementById("acc").hidden=true;
    document.getElementById("reg").hidden=true;
    document.getElementById("stu").hidden=true;
    document.getElementById("pro").hidden=true;
    document.getElementById("btns").hidden=false;
}function showReg() {
    document.getElementById("btns").hidden=true;
    document.getElementById("acc").hidden=true;
    document.getElementById("reg").hidden=false;
    document.getElementById("regType").hidden=false;
}
function showAcc(){
    document.getElementById("btns").hidden=true;
    document.getElementById("reg").hidden=true;
    document.getElementById("acc").hidden=false;
}function showStu(){
    document.getElementById("regType").hidden=true;
    document.getElementById("pro").hidden=true;
    document.getElementById("stu").hidden=false;
}function showPro(){
    document.getElementById("regType").hidden=true;
    document.getElementById("stu").hidden=true;
    document.getElementById("pro").hidden=false;
}
function showPW(){
    document.getElementById("dati").hidden=true;
    document.getElementById("pw").hidden=true;
    document.getElementById("changePW").hidden=false;
    document.getElementById("data").hidden=false;
}
function showData(){
    document.getElementById("changePW").hidden=true;
    document.getElementById("data").hidden=true;
    document.getElementById("dati").hidden=false;
    document.getElementById("pw").hidden=false;
}function errore(){
    document.getElementById("data").hidden=false;
}
function showEsami(){
    document.getElementById("esami").hidden=true;
    document.getElementById("courses").hidden=true;
    document.getElementById("avg").hidden=true;
    document.getElementById("corsi").hidden=false;
    document.getElementById("media").hidden=false;
    document.getElementById("exams").hidden=false;
}function showCorsi(){
    document.getElementById("corsi").hidden=true;
    document.getElementById("exams").hidden=true;
    document.getElementById("avg").hidden=true;
    document.getElementById("esami").hidden=false;
    document.getElementById("media").hidden=false;
    document.getElementById("courses").hidden=false;
}function showMedia(){
    document.getElementById("media").hidden=true;
    document.getElementById("exams").hidden=true;
    document.getElementById("courses").hidden=true;
    document.getElementById("esami").hidden=false;
    document.getElementById("corsi").hidden=false;
    document.getElementById("avg").hidden=false;
}function conferma(){
    reimposta=confirm("Sei sicuro di voler eliminare l'account?");
    if (reimposta === false){
        event.preventDefault();
    }
}
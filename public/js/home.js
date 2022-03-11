kutipan_ayat = ["“Tidak ada balasan kebaikan kecuali kebaikan (pula).”#QS Ar-Rahman : 60", "“Jika kamu berbuat baik (berarti) kamu berbuat baik bagi dirimu sendiri dan jika kamu berbuat jahat, maka (kejahatan) itu bagi dirimu sendiri,”#QS Al-Isra’ : 7","“Barangsiapa yang mengerjakan kebaikan seberat dzarrahpun, niscaya dia akan melihat (balasan)nya. Dan barangsiapa yang mengerjakan kejahatan sebesar dzarrahpun, niscaya dia akan melihat (balasan)nya pula.”#QS Al Zalzalah : 7-8"]
var random_ayat = kutipan_ayat[Math.floor(Math.random()*kutipan_ayat.length)];
$(document).ready(function(){
    splited_ayat = random_ayat.split("#")
    $("#kutipan-ayat").html(splited_ayat[0])
    $("#kutipan-surah").html(splited_ayat[1])
})
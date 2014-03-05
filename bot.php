<?php
// ini udah di modif supaya jadi puisi :ngakak tadinya smile dan kata kata :D
// ini gw nemu di pastebin entah punya siapa entah ketek poti or siapalah itu
// jika a sama dengan $not jika b sama dengan random array $data
// a di gunakan agar tidak mengacak data jadi cuman $not aja supaya tidak seperti bot
$set = "b";
$not=":ngacir takut di :karung :bye :ngetrek";
date_default_timezone_set("Asia/Jakarta");
//identity
$user = "akumanusia";
$pass = "fNhnvGyC";
//general data
$ua = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31";
$url_login = "http://devilzc0de.org/forum/index.php";
$url_post = "http://devilzc0de.org/forum/xmlhttp.php";
$url_smiles = "http://devilzc0de.org/forum/misc.php?action=smilies&popup=true&editor=clickableEditor";
//data to be sent

$data = array(
// pesannya yang mau di acak
"Cinta itu sebuah permainan yang dimainkan oleh dua orang dan dimenangkan oleh dua orang tersebut",
"Cinta adalah suatu kondisi di mana kebahagiaan orang lain menjadi penting bagi kebahagiaanmu",
"Cinta itu seperti angin, kau tidak bisa melihatnya tapi kau bisa merasakannya",
"Semakin besar rasa cinta, semakin besar pula tragedinya ketika cinta itu berakhir",
"Selalu ada kegilaan dalam cinta. Tapi juga selalu ada alasan dalam kegilaan",
"Mencintai demi dicintai itu sifat manusia, tapi mencintai demi mencintai itu sifat malaikat",
"Kerjakan apa yang kau cintai dan uang akan mengikuti",
"Syukurilah hidup, karena hidup memberimu kesempatan untuk mencintai, bekerja, bermain dan memandang bintang-bintang",
"Cinta dapat mengobati patah hati, kesialan, atau sebuah tragedi. Cinta itu sahabat abadi",
"Cinta tidak memiliki apapun yang ingin kau dapatkan, tapi cinta memiliki semua yang ingin kau berikan",
"Tidak ada seoarangpun orang yang jatuh cinta merasa bebas, atau ingin bebas",
"Terkadang cinta yang baru malah datang dari kawan lama. Terkadang kekasih yang baik adalah orang yang selalu ada untuk kita",
"Tempat yang paling kita cintai adalah rumah; rumah dimana kaki kita bisa saja meninggalkannya, tapi hati kita tak bisa melupakannya",
"Cinta seharusnya jadi kendaraan yang membawa kita bepergian tanpa batas",
"Sangat tidak mungkin mencintai dan sekaligus menjadi bijak",
"Cintailah tetanggamu seperti mencintai dirimu sendiri; tapi pilihlan (baik-baik) tetanggamu itu",
"Kita tidak akan tahu rasa cinta kedua orangtua kita (terhadap kita), sampai kita menjadi orang tua",
"Cinta dibentuk oleh satu jiwa yang dihuni oleh dua raga",
"Kebencian tidak akan berhenti dengan kebencian lagi; hanya dengan cinta; ini adalah aturan yang abadi",
"Hidup tanpa cinta itu ibarat pohon tanpa bunga dan buah",
"Jika kau ingin dicintai, cintailah dan jadilah orang yang bisa dicintai",
"Kau mulai mencintai bukan karena menemukan seorang yang sempurna, tapi dengan sempurna melihat orang yang tak sempurna",
"Apakah aku mencintaimu karena engkau cantik, atau apakah kau cantik karena aku mencintaimu?",
"Jika kau mencintaiku, biarkanlah aku tahu. Tapi jika tidak, tolong biarkan aku pergi",
"Cinta itu bukan apa yang dipikirkan oleh akal; tapi cinta adalah apa yang dirasakan oleh hati");
$smiles = smiles($url_smiles, $ua);
if ($set==a)
{

$post = $not;
}
else

{$post = $data[rand(0, count($data)-1)]." ".$smiXles[rand(0, count($smiles)-1)];
}//call function of login and send data
login($url_login, $user, $pass, $ua);
$send = post($url_post, $post, $ua);
//write logs
$logs = $user.": ".date("H:i:s d-m-Y")."-->".$post."-->".$send."n";
$fp = fopen("logs.txt", "a");
fwrite($fp, $logs);
echo $logs;

function login($url_login, $user, $pass, $ua){
    $data = array("action" => "do_login", "username" => $user, "password" => $pass, "loginsubmit" => "Login!");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_login);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "kookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "Kookie.txt");
    $exec = curl_exec($ch);
    curl_close($ch);
    return $exec;
}

function smiles($url_smiles, $ua){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_smiles);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "kookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "Kookie.txt");
    $exec = curl_exec($ch);
    $remove_html = strip_tags($exec);
    $pecah = explode("Click a smilie to insert it into your message", $remove_html);
    $hapus =  str_replace(array("[", "]", "close window", "n", "r", "rn"), " ", $pecah[1]);
    $hapus2 = preg_replace("/s+/", " ", $hapus);
    $smiles = explode(" ",trim($hapus2));
    curl_close($ch);
    return $smiles;

}

function post($url_post, $post, $ua){
    $data = array("action" => "add_shout", "shout_data" => $post);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_post);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "kookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "Kookie.txt");
    $exec = curl_exec($ch);
    curl_close($ch);
    return $exec;
}
?>

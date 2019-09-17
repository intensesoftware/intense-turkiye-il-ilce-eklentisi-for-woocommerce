<?php

/*
Plugin Name: Intense Türkiye İl İlçe Eklentisi For WooCommmerce
Description: WooCommerce ödeme sayfası için Türkiye'de yer alan tüm il ve ilçelerin gösterilmesini sağlar.
Version: 1.0.0
Author: Intense Yazılım
Author URI: http://intense.com.tr
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ){
    exit;
}


add_filter('woocommerce_checkout_fields', 'intense_ilce_override');

function intense_ilce_override($fields){

    if(!is_checkout())
        return;

    $fields['billing']['billing_city']['type'] = 'select';
    $fields['billing']['billing_city']['priority'] = $fields['billing']['billing_state']['priority']+1;
    $fields['billing']['billing_city']['options'] = array('0'=>'Lütfen Seçiniz');


    $fields['shipping']['shipping_city']['type'] = 'select';
    $fields['shipping']['shipping_city']['priority'] = $fields['shipping']['shipping_state']['priority']+1;
    $fields['shipping']['shipping_city']['options'] = array('0'=>'Lütfen Seçiniz');

    return $fields;

}


/**
 *
 * İlce listelerinin json olarak listelenmesi
 *
 */
add_action('wp_footer', function(){

    if(!is_checkout())
        return;

    ?>



    <script>

        var ilceler = {"TR01":["Alada\u011f","Ceyhan","\u00c7ukurova","Feke","\u0130mamo\u011flu","Karaisal\u0131","Karata\u015f","Kozan","Pozant\u0131","Saimbeyli","Sar\u0131\u00e7am","Seyhan","Tufanbeyli","Yumurtal\u0131k","Y\u00fcre\u011fir"],"TR02":["Besni","\u00c7elikhan","Gerger","G\u00f6lba\u015f\u0131","Kahta","Merkez","Samsat","Sincik","Tut"],"TR03":["Ba\u015fmak\u00e7\u0131","Bayat","Bolvadin","\u00c7ay","\u00c7obanlar","Dazk\u0131r\u0131","Dinar","Emirda\u011f","Evciler","Hocalar","\u0130hsaniye","\u0130scehisar","K\u0131z\u0131l\u00f6ren","Merkez","Sand\u0131kl\u0131","Sinanpa\u015fa","Sultanda\u011f\u0131","\u015euhut"],"TR04":["Diyadin","Do\u011fubayaz\u0131t","Ele\u015fkirt","Hamur","Merkez","Patnos","Ta\u015fl\u0131\u00e7ay","Tutak"],"TR05":["G\u00f6yn\u00fccek","G\u00fcm\u00fc\u015fhac\u0131k\u00f6y","Hamam\u00f6z\u00fc","Merkez","Merzifon","Suluova","Ta\u015fova"],"TR06":["Akyurt","Alt\u0131nda\u011f","Aya\u015f","Bala","Beypazar\u0131","\u00c7aml\u0131dere","\u00c7ankaya","\u00c7ubuk","Elmada\u011f","Etimesgut","Evren","G\u00f6lba\u015f\u0131","G\u00fcd\u00fcl","Haymana","Kahramankazan","Kalecik","Ke\u00e7i\u00f6ren","K\u0131z\u0131lcahamam","Mamak","Nall\u0131han","Polatl\u0131","Pursaklar","Sincan","\u015eerefliko\u00e7hisar","Yenimahalle"],"TR07":["Akseki","Aksu","Alanya","Demre","D\u00f6\u015femealt\u0131","Elmal\u0131","Finike","Gazipa\u015fa","G\u00fcndo\u011fmu\u015f","\u0130brad\u0131","Ka\u015f","Kemer","Kepez","Konyaalt\u0131","Korkuteli","Kumluca","Manavgat","Muratpa\u015fa","Serik"],"TR08":["Ardanu\u00e7","Arhavi","Bor\u00e7ka","Hopa","Kemalpa\u015fa","Merkez","Murgul","\u015eav\u015fat","Yusufeli"],"TR09":["Bozdo\u011fan","Buharkent","\u00c7ine","Didim","Efeler","Germencik","\u0130ncirliova","Karacasu","Karpuzlu","Ko\u00e7arl\u0131","K\u00f6\u015fk","Ku\u015fadas\u0131","Kuyucak","Nazilli","S\u00f6ke","Sultanhisar","Yenipazar"],"TR10":["Alt\u0131eyl\u00fcl","Ayval\u0131k","Balya","Band\u0131rma","Bigadi\u00e7","Burhaniye","Dursunbey","Edremit","Erdek","G\u00f6me\u00e7","G\u00f6nen","Havran","\u0130vrindi","Karesi","Kepsut","Manyas","Marmara","Sava\u015ftepe","S\u0131nd\u0131rg\u0131","Susurluk"],"TR11":["Boz\u00fcy\u00fck","G\u00f6lpazar\u0131","\u0130nhisar","Merkez","Osmaneli","Pazaryeri","S\u00f6\u011f\u00fct","Yenipazar"],"TR12":["Adakl\u0131","Gen\u00e7","Karl\u0131ova","Ki\u011f\u0131","Merkez","Solhan","Yayladere","Yedisu"],"TR13":["Adilcevaz","Ahlat","G\u00fcroymak","Hizan","Merkez","Mutki","Tatvan"],"TR14":["D\u00f6rtdivan","Gerede","G\u00f6yn\u00fck","K\u0131br\u0131sc\u0131k","Mengen","Merkez","Mudurnu","Seben","Yeni\u00e7a\u011fa"],"TR15":["A\u011flasun","Alt\u0131nyayla","Bucak","\u00c7avd\u0131r","\u00c7eltik\u00e7i","G\u00f6lhisar","Karamanl\u0131","Kemer","Merkez","Tefenni","Ye\u015filova"],"TR16":["B\u00fcy\u00fckorhan","Gemlik","G\u00fcrsu","Harmanc\u0131k","\u0130neg\u00f6l","\u0130znik","Karacabey","Keles","Kestel","Mudanya","Mustafakemalpa\u015fa","Nil\u00fcfer","Orhaneli","Orhangazi","Osmangazi","Yeni\u015fehir","Y\u0131ld\u0131r\u0131m"],"TR17":["Ayvac\u0131k","Bayrami\u00e7","Biga","Bozcaada","\u00c7an","Eceabat","Ezine","Gelibolu","G\u00f6k\u00e7eada","Lapseki","Merkez","Yenice"],"TR18":["Atkaracalar","Bayram\u00f6ren","\u00c7erke\u015f","Eldivan","Ilgaz","K\u0131z\u0131l\u0131rmak","Korgun","Kur\u015funlu","Merkez","Orta","\u015eaban\u00f6z\u00fc","Yaprakl\u0131"],"TR19":["Alaca","Bayat","Bo\u011fazkale","Dodurga","\u0130skilip","Karg\u0131","La\u00e7in","Mecit\u00f6z\u00fc","Merkez","O\u011fuzlar","Ortak\u00f6y","Osmanc\u0131k","Sungurlu","U\u011furluda\u011f"],"TR20":["Ac\u0131payam","Babada\u011f","Baklan","Bekilli","Beya\u011fa\u00e7","Bozkurt","Buldan","\u00c7al","\u00c7ameli","\u00c7ardak","\u00c7ivril","G\u00fcney","Honaz","Kale","Merkezefendi","Pamukkale","Sarayk\u00f6y","Serinhisar","Tavas"],"TR21":["Ba\u011flar","Bismil","\u00c7ermik","\u00c7\u0131nar","\u00c7\u00fcng\u00fc\u015f","Dicle","E\u011fil","Ergani","Hani","Hazro","Kayap\u0131nar","Kocak\u00f6y","Kulp","Lice","Silvan","Sur","Yeni\u015fehir"],"TR22":["Enez","Havsa","\u0130psala","Ke\u015fan","Lalapa\u015fa","Meri\u00e7","Merkez","S\u00fclo\u011flu","Uzunk\u00f6pr\u00fc"],"TR23":["A\u011f\u0131n","Alacakaya","Ar\u0131cak","Baskil","Karako\u00e7an","Keban","Kovanc\u0131lar","Maden","Merkez","Palu","Sivrice"],"TR24":["\u00c7ay\u0131rl\u0131","\u0130li\u00e7","Kemah","Kemaliye","Merkez","Otlukbeli","Refahiye","Tercan","\u00dcz\u00fcml\u00fc"],"TR25":["A\u015fkale","Aziziye","\u00c7at","H\u0131n\u0131s","Horasan","\u0130spir","Kara\u00e7oban","Karayaz\u0131","K\u00f6pr\u00fck\u00f6y","Narman","Oltu","Olur","Paland\u00f6ken","Pasinler","Pazaryolu","\u015eenkaya","Tekman","Tortum","Uzundere","Yakutiye"],"TR26":["Alpu","Beylikova","\u00c7ifteler","G\u00fcny\u00fcz\u00fc","Han","\u0130n\u00f6n\u00fc","Mahmudiye","Mihalgazi","Mihal\u0131\u00e7\u00e7\u0131k","Odunpazar\u0131","Sar\u0131cakaya","Seyitgazi","Sivrihisar","Tepeba\u015f\u0131"],"TR27":["Araban","\u0130slahiye","Karkam\u0131\u015f","Nizip","Nurda\u011f\u0131","O\u011fuzeli","\u015eahinbey","\u015eehitkamil","Yavuzeli"],"TR28":["Alucra","Bulancak","\u00c7amoluk","\u00c7anak\u00e7\u0131","Dereli","Do\u011fankent","Espiye","Eynesil","G\u00f6rele","G\u00fcce","Ke\u015fap","Merkez","Piraziz","\u015eebinkarahisar","Tirebolu","Ya\u011fl\u0131dere"],"TR29":["Kelkit","K\u00f6se","K\u00fcrt\u00fcn","Merkez","\u015eiran","Torul"],"TR30":["\u00c7ukurca","Derecik","Merkez","\u015eemdinli","Y\u00fcksekova"],"TR31":["Alt\u0131n\u00f6z\u00fc","Antakya","Arsuz","Belen","Defne","D\u00f6rtyol","Erzin","Hassa","\u0130skenderun","K\u0131r\u0131khan","Kumlu","Payas","Reyhanl\u0131","Samanda\u011f","Yaylada\u011f\u0131"],"TR32":["Aksu","Atabey","E\u011firdir","Gelendost","G\u00f6nen","Ke\u00e7iborlu","Merkez","Senirkent","S\u00fct\u00e7\u00fcler","\u015earkikaraa\u011fa\u00e7","Uluborlu","Yalva\u00e7","Yeni\u015farbademli"],"TR33":["Akdeniz","Anamur","Ayd\u0131nc\u0131k","Bozyaz\u0131","\u00c7aml\u0131yayla","Erdemli","G\u00fclnar","Mezitli","Mut","Silifke","Tarsus","Toroslar","Yeni\u015fehir"],"TR34":["Adalar","Arnavutk\u00f6y","Ata\u015fehir","Avc\u0131lar","Ba\u011fc\u0131lar","Bah\u00e7elievler","Bak\u0131rk\u00f6y","Ba\u015fak\u015fehir","Bayrampa\u015fa","Be\u015fikta\u015f","Beykoz","Beylikd\u00fcz\u00fc","Beyo\u011flu","B\u00fcy\u00fck\u00e7ekmece","\u00c7atalca","\u00c7ekmek\u00f6y","Esenler","Esenyurt","Ey\u00fcpsultan","Fatih","Gaziosmanpa\u015fa","G\u00fcng\u00f6ren","Kad\u0131k\u00f6y","Ka\u011f\u0131thane","Kartal","K\u00fc\u00e7\u00fck\u00e7ekmece","Maltepe","Pendik","Sancaktepe","Sar\u0131yer","Silivri","Sultanbeyli","Sultangazi","\u015eile","\u015ei\u015fli","Tuzla","\u00dcmraniye","\u00dcsk\u00fcdar","Zeytinburnu"],"TR35":["Alia\u011fa","Bal\u00e7ova","Bay\u0131nd\u0131r","Bayrakl\u0131","Bergama","Beyda\u011f","Bornova","Buca","\u00c7e\u015fme","\u00c7i\u011fli","Dikili","Fo\u00e7a","Gaziemir","G\u00fczelbah\u00e7e","Karaba\u011flar","Karaburun","Kar\u015f\u0131yaka","Kemalpa\u015fa","K\u0131n\u0131k","Kiraz","Konak","Menderes","Menemen","Narl\u0131dere","\u00d6demi\u015f","Seferihisar","Sel\u00e7uk","Tire","Torbal\u0131","Urla"],"TR36":["Akyaka","Arpa\u00e7ay","Digor","Ka\u011f\u0131zman","Merkez","Sar\u0131kam\u0131\u015f","Selim","Susuz"],"TR37":["Abana","A\u011fl\u0131","Ara\u00e7","Azdavay","Bozkurt","Cide","\u00c7atalzeytin","Daday","Devrekani","Do\u011fanyurt","Han\u00f6n\u00fc","\u0130hsangazi","\u0130nebolu","K\u00fcre","Merkez","P\u0131narba\u015f\u0131","Seydiler","\u015eenpazar","Ta\u015fk\u00f6pr\u00fc","Tosya"],"TR38":["Akk\u0131\u015fla","B\u00fcnyan","Develi","Felahiye","Hac\u0131lar","\u0130ncesu","Kocasinan","Melikgazi","\u00d6zvatan","P\u0131narba\u015f\u0131","Sar\u0131o\u011flan","Sar\u0131z","Talas","Tomarza","Yahyal\u0131","Ye\u015filhisar"],"TR39":["Babaeski","Demirk\u00f6y","Kof\u00e7az","L\u00fcleburgaz","Merkez","Pehlivank\u00f6y","P\u0131narhisar","Vize"],"TR40":["Ak\u00e7akent","Akp\u0131nar","Boztepe","\u00c7i\u00e7ekda\u011f\u0131","Kaman","Merkez","Mucur"],"TR41":["Ba\u015fiskele","\u00c7ay\u0131rova","Dar\u0131ca","Derince","Dilovas\u0131","Gebze","G\u00f6lc\u00fck","\u0130zmit","Kand\u0131ra","Karam\u00fcrsel","Kartepe","K\u00f6rfez"],"TR42":["Ah\u0131rl\u0131","Ak\u00f6ren","Ak\u015fehir","Alt\u0131nekin","Bey\u015fehir","Bozk\u0131r","Cihanbeyli","\u00c7eltik","\u00c7umra","Derbent","Derebucak","Do\u011fanhisar","Emirgazi","Ere\u011fli","G\u00fcneys\u0131n\u0131r","Hadim","Halkap\u0131nar","H\u00fcy\u00fck","Ilg\u0131n","Kad\u0131nhan\u0131","Karap\u0131nar","Karatay","Kulu","Meram","Saray\u00f6n\u00fc","Sel\u00e7uklu","Seydi\u015fehir","Ta\u015fkent","Tuzluk\u00e7u","Yal\u0131h\u00fcy\u00fck","Yunak"],"TR43":["Alt\u0131nta\u015f","Aslanapa","\u00c7avdarhisar","Domani\u00e7","Dumlup\u0131nar","Emet","Gediz","Hisarc\u0131k","Merkez","Pazarlar","Simav","\u015eaphane","Tav\u015fanl\u0131"],"TR44":["Ak\u00e7ada\u011f","Arapgir","Arguvan","Battalgazi","Darende","Do\u011fan\u015fehir","Do\u011fanyol","Hekimhan","Kale","Kuluncak","P\u00fct\u00fcrge","Yaz\u0131han","Ye\u015filyurt"],"TR45":["Ahmetli","Akhisar","Ala\u015fehir","Demirci","G\u00f6lmarmara","G\u00f6rdes","K\u0131rka\u011fa\u00e7","K\u00f6pr\u00fcba\u015f\u0131","Kula","Salihli","Sar\u0131g\u00f6l","Saruhanl\u0131","Selendi","Soma","\u015eehzadeler","Turgutlu","Yunusemre"],"TR46":["Af\u015fin","And\u0131r\u0131n","\u00c7a\u011flayancerit","Dulkadiro\u011flu","Ekin\u00f6z\u00fc","Elbistan","G\u00f6ksun","Nurhak","Oniki\u015fubat","Pazarc\u0131k","T\u00fcrko\u011flu"],"TR47":["Artuklu","Darge\u00e7it","Derik","K\u0131z\u0131ltepe","Maz\u0131da\u011f\u0131","Midyat","Nusaybin","\u00d6merli","Savur","Ye\u015filli"],"TR48":["Bodrum","Dalaman","Dat\u00e7a","Fethiye","Kavakl\u0131dere","K\u00f6yce\u011fiz","Marmaris","Mente\u015fe","Milas","Ortaca","Seydikemer","Ula","Yata\u011fan"],"TR49":["Bulan\u0131k","Hask\u00f6y","Korkut","Malazgirt","Merkez","Varto"],"TR50":["Ac\u0131g\u00f6l","Avanos","Derinkuyu","G\u00fcl\u015fehir","Hac\u0131bekta\u015f","Kozakl\u0131","Merkez","\u00dcrg\u00fcp"],"TR51":["Altunhisar","Bor","\u00c7amard\u0131","\u00c7iftlik","Merkez","Uluk\u0131\u015fla"],"TR52":["Akku\u015f","Alt\u0131nordu","Aybast\u0131","\u00c7ama\u015f","\u00c7atalp\u0131nar","\u00c7ayba\u015f\u0131","Fatsa","G\u00f6lk\u00f6y","G\u00fclyal\u0131","G\u00fcrgentepe","\u0130kizce","Kabad\u00fcz","Kabata\u015f","Korgan","Kumru","Mesudiye","Per\u015fembe","Ulubey","\u00dcnye"],"TR53":["Arde\u015fen","\u00c7aml\u0131hem\u015fin","\u00c7ayeli","Derepazar\u0131","F\u0131nd\u0131kl\u0131","G\u00fcneysu","Hem\u015fin","\u0130kizdere","\u0130yidere","Kalkandere","Merkez","Pazar"],"TR54":["Adapazar\u0131","Akyaz\u0131","Arifiye","Erenler","Ferizli","Geyve","Hendek","Karap\u00fcr\u00e7ek","Karasu","Kaynarca","Kocaali","Pamukova","Sapanca","Serdivan","S\u00f6\u011f\u00fctl\u00fc","Tarakl\u0131"],"TR55":["19 may\u0131s","Ala\u00e7am","Asarc\u0131k","Atakum","Ayvac\u0131k","Bafra","Canik","\u00c7ar\u015famba","Havza","\u0130lkad\u0131m","Kavak","Ladik","Sal\u0131pazar\u0131","Tekkek\u00f6y","Terme","Vezirk\u00f6pr\u00fc","Yakakent"],"TR56":["Baykan","Eruh","Kurtalan","Merkez","Pervari","\u015eirvan","Tillo"],"TR57":["Ayanc\u0131k","Boyabat","Dikmen","Dura\u011fan","Erfelek","Gerze","Merkez","Sarayd\u00fcz\u00fc","T\u00fcrkeli"],"TR58":["Ak\u0131nc\u0131lar","Alt\u0131nyayla","Divri\u011fi","Do\u011fan\u015far","Gemerek","G\u00f6lova","G\u00fcr\u00fcn","Hafik","\u0130mranl\u0131","Kangal","Koyulhisar","Merkez","Su\u015fehri","\u015eark\u0131\u015fla","Ula\u015f","Y\u0131ld\u0131zeli","Zara"],"TR59":["\u00c7erkezk\u00f6y","\u00c7orlu","Ergene","Hayrabolu","Kapakl\u0131","Malkara","Marmaraere\u011flisi","Muratl\u0131","Saray","S\u00fcleymanpa\u015fa","\u015eark\u00f6y"],"TR60":["Almus","Artova","Ba\u015f\u00e7iftlik","Erbaa","Merkez","Niksar","Pazar","Re\u015fadiye","Sulusaray","Turhal","Ye\u015filyurt","Zile"],"TR61":["Ak\u00e7aabat","Arakl\u0131","Arsin","Be\u015fikd\u00fcz\u00fc","\u00c7ar\u015f\u0131ba\u015f\u0131","\u00c7aykara","Dernekpazar\u0131","D\u00fczk\u00f6y","Hayrat","K\u00f6pr\u00fcba\u015f\u0131","Ma\u00e7ka","Of","Ortahisar","S\u00fcrmene","\u015ealpazar\u0131","Tonya","Vakf\u0131kebir","Yomra"],"TR62":["\u00c7emi\u015fgezek","Hozat","Mazgirt","Merkez","Naz\u0131miye","Ovac\u0131k","Pertek","P\u00fcl\u00fcm\u00fcr"],"TR63":["Ak\u00e7akale","Birecik","Bozova","Ceylanp\u0131nar","Eyy\u00fcbiye","Halfeti","Haliliye","Harran","Hilvan","Karak\u00f6pr\u00fc","Siverek","Suru\u00e7","Viran\u015fehir"],"TR64":["Banaz","E\u015fme","Karahall\u0131","Merkez","Sivasl\u0131","Ulubey"],"TR65":["Bah\u00e7esaray","Ba\u015fkale","\u00c7ald\u0131ran","\u00c7atak","Edremit","Erci\u015f","Geva\u015f","G\u00fcrp\u0131nar","\u0130pekyolu","Muradiye","\u00d6zalp","Saray","Tu\u015fba"],"TR66":["Akda\u011fmadeni","Ayd\u0131nc\u0131k","Bo\u011fazl\u0131yan","\u00c7and\u0131r","\u00c7ay\u0131ralan","\u00c7ekerek","Kad\u0131\u015fehri","Merkez","Saraykent","Sar\u0131kaya","Sorgun","\u015eefaatli","Yenifak\u0131l\u0131","Yerk\u00f6y"],"TR67":["Alapl\u0131","\u00c7aycuma","Devrek","Ere\u011fli","G\u00f6k\u00e7ebey","Kilimli","Kozlu","Merkez"],"TR68":["A\u011fa\u00e7\u00f6ren","Eskil","G\u00fcla\u011fa\u00e7","G\u00fczelyurt","Merkez","Ortak\u00f6y","Sar\u0131yah\u015fi","Sultanhan\u0131"],"TR69":["Ayd\u0131ntepe","Demir\u00f6z\u00fc","Merkez"],"TR70":["Ayranc\u0131","Ba\u015fyayla","Ermenek","Kaz\u0131mkarabekir","Merkez","Sar\u0131veliler"],"TR71":["Bah\u015fili","Bal\u0131\u015feyh","\u00c7elebi","Delice","Karake\u00e7ili","Keskin","Merkez","Sulakyurt","Yah\u015fihan"],"TR72":["Be\u015firi","Gerc\u00fc\u015f","Hasankeyf","Kozluk","Merkez","Sason"],"TR73":["Beyt\u00fc\u015f\u015febap","Cizre","G\u00fc\u00e7l\u00fckonak","\u0130dil","Merkez","Silopi","Uludere"],"TR74":["Amasra","Kuruca\u015file","Merkez","Ulus"],"TR75":["\u00c7\u0131ld\u0131r","Damal","G\u00f6le","Hanak","Merkez","Posof"],"TR76":["Aral\u0131k","Karakoyunlu","Merkez","Tuzluca"],"TR77":["Alt\u0131nova","Armutlu","\u00c7\u0131narc\u0131k","\u00c7iftlikk\u00f6y","Merkez","Termal"],"TR78":["Eflani","Eskipazar","Merkez","Ovac\u0131k","Safranbolu","Yenice"],"TR79":["Elbeyli","Merkez","Musabeyli","Polateli"],"TR80":["Bah\u00e7e","D\u00fczi\u00e7i","Hasanbeyli","Kadirli","Merkez","Sumbas","Toprakkale"],"TR81":["Ak\u00e7akoca","Cumayeri","\u00c7ilimli","G\u00f6lyaka","G\u00fcm\u00fc\u015fova","Kayna\u015fl\u0131","Merkez","Y\u0131\u011f\u0131lca"]}

    </script>


    <?php


});



add_action('wp_footer', 'ilcelerin_listelenmesi');

function ilcelerin_listelenmesi(){

    if(!is_checkout())
        return;

    ?>

    <script>

        jQuery('document').ready(function(){

            jQuery('#billing_state').on('change', function(){

                // eski verileri temizle
                jQuery('#billing_city').empty();
                jQuery('#billing_city').append(new Option('Lütfen Seçiniz', 0));

                let billing_il = jQuery('#billing_state').val();

                jQuery.each(ilceler[billing_il], function(key,value){

                    // yeni ilceleri ekle
                    var opt = new Option(value, value);
                    jQuery(opt).html(value);
                    jQuery('#billing_city').append(opt);

                });

                jQuery('#billing_city').append(ilceler.TR01);


            });



            jQuery('#shipping_state').on('change', function(){

                // eski verileri temizle
                jQuery('#shipping_city').empty();
                jQuery('#shipping_city').append(new Option('Lütfen Seçiniz', 0));

                let billing_il = jQuery('#shipping_state').val();

                jQuery.each(ilceler[billing_il], function(key,value){

                    // yeni ilceleri ekle
                    var opt = new Option(value, value);
                    jQuery(opt).html(value);
                    jQuery('#shipping_city').append(opt);

                });

                jQuery('#shipping_city').append(ilceler.TR01);


            });

        });

    </script>

    <?php


}
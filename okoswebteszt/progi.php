<?php
error_reporting(0);
require 'functions.php';
require 'var.php';
echo $cln;
system("clear");
redhawk_banner();
if (extension_loaded('curl') || extension_loaded('dom'))
  {
  }
else
  {
    if (!extension_loaded('curl'))
      {
        echo $bold . $red . "\n[!] A cURL modul nem talalhato! Hasznald a  'fix' parancsot" . $cln;
      }
    if (!extension_loaded('dom'))
      {
        echo $bold . $red . "\n[!] A DOM modul nem talalhato! Hasznald a  'fix' parancsot\n" . $cln;
      }
  }
thephuckinstart:
echo "\n";
userinput("Ird be a tesztelni kivant oldalt ");
$ip = trim(fgets(STDIN, 1024));
if ($ip == "help")
  {
    echo "\n\n[+] Segitseg [+] \n\n";
    echo $bold . $lblue . "Parancsok\n";
    echo "========\n";
    echo $fgreen . "[1] help:$cln A segitseg menube\n";
    echo $bold . $fgreen . "[2] fix:$cln Az osszes szukseges modul telepitese (Ha eloszor hasznalod a programot, ez kell neked :) )\n";
    echo $bold . $fgreen . "[3] URL:$cln Ird be a tesztelni kivant weboldal URL-jet (Pelda:www.sample.com / sample.com)\n";
    goto thephuckinstart;
  }
elseif ($ip == "fix")
  {
    echo "\n\e[91m\e[1m[+] Hibakereso [+]\n\n$cln";
    echo $bold . $blue . "[+] A cURL modul ellenorzese ...\n";
    if (!extension_loaded('curl'))
      {
        echo $bold . $red . "[!] A cURL modul nincs telepitve! \n";
        echo $yellow . "[*] cURL installalasa. (Sudo jogosultsag szukseges) \n" . $cln;
        system("sudo apt-get -qq --assume-yes install php-curl");
        echo $bold . $fgreen . "[i] cURL telepitve. \n";
      }
    else
      {
        echo $bold . $fgreen . "[i] cURL telepitve, Nezzuk mi kellhet meg \n";
      }
    echo $bold . $blue . "[+] A php-XML modul ellenorzese ...\n";
    if (!extension_loaded('dom'))
      {
        echo $bold . $red . "[!] A php-XML nincs telepitve! \n";
        echo $yellow . "[*] php-XML insallalasa. (Sudo jogosultsag szukseges) \n" . $cln;
        system("sudo apt-get -qq --assume-yes install php-xml");
        echo $bold . $fgreen . "[i] DOM telepitve. \n";
      }
    else
      {
        echo $bold . $fgreen . "[i] A php-XML telepitve van, Minden keszen all ;) \n";
      }
    echo $bold . $fgreen . "[i] Kerlek indits ujra a programot\n";
    exit;
  }
elseif (strpos($ip, '://') !== false)
  {
    echo $bold . $red . "\n[!] HTTP/HTTPS nelkul ird be a tesztelni kivant weboldalt\n" . $CURLOPT_RETURNTRANSFER;
    goto thephuckinstart;
  }
elseif (strpos($ip, '.') == false)
  {
    echo $bold . $red . "\n[!] Ervenytelen formatum\n" . $cln;
    goto thephuckinstart;
  }
elseif (strpos($ip, ' ') !== false)
  {
    echo $bold . $red . "\n[!] Ervenytelen formatum\n" . $cln;
    goto thephuckinstart;
  }
else
  {
    echo "\n";
    userinput("URI-sema: 1-HTTP 2-HTTPS (Utsd be a szamot)");
    echo $cln . $bold . $fgreen;
    $ipsl = trim(fgets(STDIN, 1024));
    if ($ipsl == "2")
      {
        $ipsl = "https://";
      }
    else
      {
        $ipsl = "http://";
      }
scanlist:

    system("clear");
    echo $bold . $blue . "
      +--------------------------------------------------------------+
      PARANCSOK LISTAJA      +--------------------------------------------------------------+

            $lblue Celpont : " . $fgreen . $ipsl . $ip . $blue . "
      \n\n";
    echo $yellow . " [0]  Alapadatok Megszerzese$white (Weboldal cime, IP Cim, Tartalomkezelo rendszer (CMS), Cloudflare , Robots.txt keresese)$yellow \n [1]  Whois Adatok \n [2]  Foldrajzi helyzet \n [3]  Bannerek felkutatasa \n [4]  Nevszerverek (DNS) \n [5]  Subnet kalkulator \n [6]  NMAP Port Szkenner \n [7]  Altartomany Szkenner \n [8]  CMS kereso \n [9]  SQLi Sebezhetoseg$white (SQLi Injection-re)$yellow \n [10] Kiszivargott adatok$white (Hasznos informaciok begyujtese)$yellow \n [11] WordPress Teszt$white (Akkor mukodik csak, ha a weboldal WP-t hasznal)$yellow \n [12] URI-k gyujtese \n [13] MX adatok \n$magenta [A]  Teszteljunk mindent \n$blue [F]  Fix (Kijavitja az esetleges hibakat, ha nem fut megfeleloen a program) \n$fgreen [U]  Frissitesek keresese \n$white [B]  Masik weboldalt szeretnek tesztelni(Vissza a menube) \n$red [Q]  Quit! \n\n" . $cln;
askscan:
    userinput("Valassz a felsorolt funkciok kozul");
    $scan = trim(fgets(STDIN, 1024));

    if (!in_array($scan, array(
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',
        '13',
        'F',
        'f',
        'A',
        'B',
        'U',
        'Q',
        'a',
        'b',
        'q',
        'u'
    ), true))
      {
        echo $bold . $red . "\n[!] Nincs ilyen opcio! \n\n" . $cln;
        goto askscan;
      }
    else
      {
        if ($scan == "15")
          {
            goto thephuckinstart;
          }
        elseif ($scan == 'q' | $scan == 'Q')
          {
            echo "\n\n\t Tovabbi szep napot :)\n\n";
            die();
          }
        elseif ($scan == 'b' || $scan == 'B')
          {
            system("clear");
            goto thephuckinstart;
          }
        elseif ($scan == "0")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Adatok betoltese ... \n";
            echo $blue . $bold . "[i] Tesztelt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : Alapadatok kinyerese" . $cln;
            echo "\n\n";
            echo $bold . $lblue . "[iNFO] Az oldal cime: " . $green;
            echo getTitle($reallink);
            echo $cln;
            $wip = gethostbyname($ip);
            echo $lblue . $bold . "\n[iNFO] IP cim: " . $green . $wip . "\n" . $cln;
            echo $bold . $lblue . "[iNFO] Szerver: ";
            WEBserver($reallink);
            echo "\n";
            echo $bold . $lblue . "[iNFO] CMS: \e[92m" . CMSdetect($reallink) . $cln;
            echo $lblue . $bold . "\n[iNFO] Cloudflare: ";
            cloudflaredetect($lwwww);
            echo $lblue . $bold . "[iNFO] Robots.txt fajl:$cln ";
            robotsdottxt($reallink);
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "1")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Betoltes ... \n";
            echo $blue . $bold . "[i] Vizsgalt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : WHOIS adatok kinyerese" . $cln;
            echo $bold . $lblue . "\n[~] Whois adatok: \n\n" . $cln;
            $urlwhois    = "http://api.hackertarget.com/whois/?q=" . $lwwww;
            $resultwhois = file_get_contents($urlwhois);
            echo $bold . $fgreen . $resultwhois;
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "2")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Betoltes ... \n";
            echo $blue . $bold . "[i] Vizsgalt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : Szerver foldrajzi helyenek meghatarozasa" . $cln;
            echo "\n\n";
            $urlgip    = "http://api.hackertarget.com/geoip/?q=" . $lwwww;
            $resultgip = readcontents($urlgip);
            $geoips    = explode("\n", $resultgip);
            foreach ($geoips as $geoip)
              {
                echo $bold . $lblue . "[GEO-IP]$green $geoip \n";
              }
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "3")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Adatok begyujtese ... \n";
            echo $blue . $bold . "[i] Vizsgalt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : Bannerek listazasa" . $cln;
            echo "\n\n";
            $hdr = get_headers($reallink);
            foreach ($hdr as $shdr)
              {
                echo $bold . $lblue . "\n" . $green . $shdr;
              }
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "4")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Adatok betoltese ... \n";
            echo $blue . $bold . "[i] Vizsgalt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : Nevszerver adatok (DNS)" . $cln;
            echo "\n\n";
            $urldlup    = "http://api.hackertarget.com/dnslookup/?q=" . $lwwww;
            $resultdlup = readcontents($urldlup);
            $dnslookups = trim($resultdlup, "\n");
            $dnslookups = explode("\n", $dnslookups);
            foreach ($dnslookups as $dnslkup)
              {
                echo $bold . $lblue . "\n[DNS Adatok] " . $green . $dnslkup;
              }
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "5")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Betoltes ... \n";
            echo $blue . $bold . "[i] Vizsgalt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : SubNet kalkulator" . $cln;
            echo "\n\n";
            $urlscal    = "http://api.hackertarget.com/subnetcalc/?q=" . $lwwww;
            $resultscal = readcontents($urlscal);
            $subnetcalc = trim($resultscal, "\n");
            $subnetcalc = explode("\n", $subnetcalc);
            foreach ($subnetcalc as $sc)
              {
                echo $bold . $lblue . "\n[SubNet kalkulator] " . $green . $sc;
              }
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "7")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Altartomanyok keresese ... \n";
            echo $blue . $bold . "[i] Szkennelt weboldal :\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : Altartomanyok listazasa" . $cln;
            $urlsd      = "http://api.hackertarget.com/hostsearch/?q=" . $lwwww;
            $resultsd   = readcontents($urlsd);
            $subdomains = trim($resultsd, "\n");
            $subdomains = explode("\n", $subdomains);
            unset($subdomains['0']);
            $sdcount = count($subdomains);
            echo "\n" . $blue . $bold . "[i] Talalt altartomanyok : " . $green . $sdcount . "\n\n" . $cln;
            foreach ($subdomains as $subdomain)
              {
                echo $bold . $lblue . "[+] Altartomany: $fgreen" . (str_replace(",", "\n\e[36m[-] IP: $fgreen", $subdomain));
                echo "\n\n" . $cln;
              }
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "6")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] NMAP inditasa ... \n";
            echo $blue . $bold . "[i] Szkennelt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : Port szkenner" . $cln;
            echo $bold . $lblue . "\n[~] Portok allapota : \n\n" . $cln;
            $urlnmap    = "http://api.hackertarget.com/nmap/?q=" . $lwwww;
            $resultnmap = readcontents($urlnmap);
            echo $bold . $fgreen . $resultnmap;
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "8")
          {
            $reallink  = $ipsl . $ip;
            $lwwww     = str_replace("www.", "", $ip);
            $detectcms = "yes";
            echo "\n$cln" . $lblue . $bold . "[+] Betoltes ... \n";
            echo $blue . $bold . "[i] Vilzsgalt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : Tartalomkezelo analizalasa (CMS)" . $cln;
            echo "\n";
            $sth = 'http://domains.yougetsignal.com/domains.php';
            $ch  = curl_init($sth);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress=$ip&ket=");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            $resp  = curl_exec($ch);
            $resp  = str_replace("[", "", str_replace("]", "", str_replace("\"\"", "", str_replace(", ,", ",", str_replace("{", "", str_replace("{", "", str_replace("}", "", str_replace(", ", ",", str_replace(", ", ",", str_replace("'", "", str_replace("'", "", str_replace(":", ",", str_replace('"', '', $resp)))))))))))));
            $array = explode(",,", $resp);
            unset($array[0]);

            echo $bold . $lblue . "[i] Talalatok :$cln " . $green . count($array) . "\n\n$cln";
            if (count($array) > 0)
              {
                userinput("Szeretned, hogy a program felkutassa az oldal CMS adatait? [Y/N]");
                $detectcmsui = trim(fgets(STDIN, 1024));
                if ($detectcmsui == "y" | $detectcmsui == "Y")
                  {
                    $detectcms = "yes";
                  }
                else
                  {
                    $detectcms = "no";
                  }
              }
            foreach ($array as $izox)
              {
                $izox   = str_replace(",", "", $izox);
                $cmsurl = "http://" . $izox;
                echo "\n" . $bold . $lblue . "WEBOLDAL : " . $fgreen . $izox . $cln;
                echo "\n" . $bold . $lblue . "IP       : " . $fgreen . gethostbyname($izox) . $cln . "\n";
                if ($detectcms == "yes")
                  {
                    echo $lblue . $bold . "CMS      : " . $green . CMSdetect($cmsurl) . $cln . "\n\n";
                  }
              }
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "9")
          {
            $reallink = $ipsl . $ip;
            $srccd    = file_get_contents($reallink);
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] SQL vizsgalo inditasa ... \n";
            echo $blue . $bold . "[i] Vizsgalt weboldal:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs: SQL sebezhetoseg keresese" . $cln;
            echo "\n\n";
            $lulzurl = $reallink;
            $html    = file_get_contents($lulzurl);
            $dom     = new DOMDocument;
            @$dom->loadHTML($html);
            $links = $dom->getElementsByTagName('a');
            $vlnk  = 0;
            foreach ($links as $link)
              {
                $lol = $link->getAttribute('href');
                if (strpos($lol, '?') !== false)
                  {
                    echo $lblue . $bold . "\n[ LINK ] " . $fgreen . $lol . "\n" . $cln;
                    echo $blue . $bold . "[ SQLi ] ";
                    $sqllist = file_get_contents('sqlerrors.ini');
                    $sqlist  = explode(',', $sqllist);
                    if (strpos($lol, '://') !== false)
                      {
                        $sqlurl = $lol . "'";
                      }
                    else
                      {
                        $sqlurl = $ipsl . $ip . "/" . $lol . "'";
                      }
                    $sqlsc = file_get_contents($sqlurl);
                    $sqlvn = $bold . $red . "Not Vulnerable";
                    foreach ($sqlist as $sqli)
                      {
                        if (strpos($sqlsc, $sqli) !== false)
                            $sqlvn = $green . $bold . "Vulnerable!";
                      }
                    echo $sqlvn;
                    echo "\n$cln";
                    echo "\n";
                    $vlnk++;
                  }
              }
            echo "\n" . $blue . $bold . "[+] Talalt URL-ek : " . $green . $vlnk;
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "10")
          {
            $reallink = $ipsl . $ip;
            $srccd    = readcontents($reallink);
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln\t" . $lblue . $bold . "[+] Hasznos linkek [+] \n\n";
            echo $blue . $bold . "[i] Vizsgalt weboldal :\e[92m $ipsl" . "$ip \n";
            echo "\n\n";
            $test_url = $reallink;
            $handle   = curl_init($test_url);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            $tu_response        = curl_exec($handle);
            $test_url_http_code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            echo $lblue . $bold . "[i] HTTP valasz kod : " . $fgreen . $test_url_http_code . "\n";
            echo $lblue . "[i] Oldal cime: " . $fgreen . getTitle($reallink) . "\n";
            echo $lblue . "[i] CMS (Tartalomkezelo rendszer) : " . $fgreen . CMSdetect($reallink) . "\n";
            echo $lblue . $bold . "[i] Alexa Global eredmeny : " . $fgreen . bv_get_alexa_rank($lwwww) . "\n";
            bv_moz_info($lwwww);
            extract_social_links($srccd);
            extractLINKS($reallink);
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == "11")
          {
            userinput("Ird be a konyvtarat, ahova a WordPress van telepitve (pl /wordpress) Ha ez itt fut " . $ipsl . $ip . " csak szimplan nyomj entert");
            $wp_inst_loc = trim(fgets(STDIN, 1024));
            if ($wp_inst_loc == "")
              {
                $reallink = $ipsl . $ip;
              }
            else
              {
                $reallink = $ipsl . $ip . $wp_inst_loc;
              }
            echo "\n$cln" . $lblue . $bold . "[+] WP Scan betoltese ... \n";
            echo $blue . $bold . "[i] Vizsgalt weboldal:\e[92m $reallink \n";
            echo $bold . $yellow . "[S] Parancs : WordPress Szkenner." . $cln;
            echo "\n\n";
            echo $bold . $blue . "[+] A program megvizsgalja, hogy az adott oldal WordPress-t hasznal-e : ";
            $srccd = readcontents($reallink);
            if (strpos($srccd, "wp-content") !== false)
              {
                echo $fgreen . "Talalat !" . $cln . "\n";
                echo $bold . $yellow . "\n\t Basic Checks \n\t==============\n\n";
                $wp_rm_src = readcontents($reallink . "/readme.html");
                if (strpos($wp_rm_src, "Ajjajj.") !== false)
                  {
                    echo $fgreen . "[i] Readme fajl elerheto, itt: " . $reallink . "/readme.html\n";
                  }
                else
                  {
                    echo $red . "[!] Readme fajl-t nem elerheto!\n";
                  }
                $wp_lic_src = readcontents($reallink . "/license.txt");
                if (strpos($wp_lic_src, "WordPress - Web publishing software") !== false)
                  {
                    echo $fgreen . "[i] License fajl elerheto, itt: " . $reallink . "/license.txt\n";
                  }
                else
                  {
                    echo $red . "[!] License fajl nem elerheto!\n";
                  }
                $wp_updir_src = readcontents($reallink . "/wp-content/uploads/");
                if (strpos($wp_updir_src, "Index of /wp-content/uploads") !== false)
                  {
                    echo $fgreen . $reallink . "/wp-content/uploads Is Browseable\n";
                  }
                $wp_xmlrpc_src = readcontents($reallink . "/xmlrpc.php");
                if (strpos($wp_xmlrpc_src, "XML-RPC server accepts POST requests only.") !== false)
                  {
                    echo $fgreen . "[i] XML-RPC interface talalat " . $reallink . "/xmlrpc.php\n";
                  }
                else
                  {
                    echo $red . "[!] Nem elerheto XML-RPC interface\n";
                  }
                echo $bold . $blue . "[+] WordPress verzio analizalva : ";
                $metaver = preg_match('/<meta name="generator" content="WordPress (.*?)\"/ims', $srccd, $matches) ? $matches[1] : null;
                if ($metaver != "")
                  {
                    echo $fgreen . "Talalat" . "\n";
                    echo $blue . "[i] WordPress verzio: " . $fgreen . $metaver . $cln;
                    $wp_version   = str_replace(".", "", $metaver);
                    $wp_c_version = $metaver;
                  }
                else
                  {
                    $feedsrc = readcontents($reallink . "/feed/");
                    $feedver = preg_match('#<generator>http://wordpress.org/\?v=(.*?)</generator>#ims', $feedsrc, $matches) ? $matches[1] : null;
                    if ($feedver != "")
                      {
                        echo $fgreen . "Talalat" . "\n";
                        echo $blue . "[i] WordPress verzio: " . $fgreen . $feedver . $cln;
                        $wp_version   = str_replace(".", "", $feedver);
                        $wp_c_version = $feedver;
                      }
                    else
                      {
                        $lopmlsrc = readcontents($reallink . "/wp-links-opml.php");
                        $lopmlver = preg_match('#generator="wordpress/(.*?)"#ims', $feedsrc, $matches) ? $matches[1] : null;
                        if ($lopmlver != "")
                          {
                            echo $fgreen . "Talalat" . "\n";
                            echo $blue . "[i] WordPress verzio: " . $fgreen . $lopmlver . $cln;
                            $wp_version   = str_replace(".", "", $lopmlver);
                            $wp_c_version = $lopmlver;
                          }
                      }
                  }
                if ($wp_version != "")
                  {
                    echo "\n" . $bold . $blue . "[+] Verzio reszleteinek osszegyujtese a WPVulnDB-bol: ";
                    $vuln_json = readcontents("https://wpvulndb.com/api/v2/wordpresses/" . $wp_version);
                    if (strpos($vuln_json, "The page you were looking for doesn't exist (404)") !== false)
                      {
                        echo $red . "[!] Nem jo :(\n";
                      }
                    else
                      {
                        $vuln_array = json_decode($vuln_json, TRUE);
                        echo $fgreen . "Kesz\n\n";
                        echo $yellow . "\t WordPress verzio Informaciok\n\t================================\n\n";
                        echo $lblue . "[i] WordPress verzio   : " . $fgreen . $wp_c_version . "\n";
                        echo $lblue . "[i] Letrehozas datuma        : " . $fgreen . $vuln_array[$wp_c_version]["release_date"] . "\n";
                        echo $lblue . "[i] Changelog URL       : " . $fgreen . $vuln_array[$wp_c_version]["changelog_url"] . "\n";
                        echo $lblue . "[i] Sebezhetoseg : " . $fgreen . count($vuln_array[$wp_c_version]["vulnerabilities"]) . "\n";
                        if (count($vuln_array[$wp_c_version]["vulnerabilities"]) != "0")
                          {
                            echo $yellow . "\n\t Verzio sebezhetosegei \n\t=========================\n\n";
                            $ver_vuln_array = $vuln_array[$wp_c_version]['vulnerabilities'];
                            foreach ($ver_vuln_array as $vuln_s)
                              {
                                echo $lblue . "[i] Sebezhetoseg : " . $fgreen . $vuln_s["title"] . "\n";
                                echo $lblue . "[i] Sebezhetoseg tipusa  : " . $fgreen . $vuln_s["vuln_type"] . "\n";
                                echo $lblue . "[i] Javitva ebben a verzioban    : " . $fgreen . $vuln_s["fixed_in"] . "\n";
                                echo $lblue . "[i] Linkek a sebezhetosegrol  : " . $fgreen . "http://wpvulndb.com/vulnerabilities/" . $vuln_s['id'] . "\n";
                                foreach ($vuln_s['references']["cve"] as $wp_cve)
                                  {
                                    echo $lblue . "[i] Vuln CVE            : " . $fgreen . "http://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-" . $wp_cve . "\n";
                                  }
                                foreach ($vuln_s['references']['exploitdb'] as $wp_edb)
                                  {
                                    echo $lblue . "[i] ExploitDB Link      : " . $fgreen . "http://www.exploit-db.com/exploits/" . $wp_edb . "\n";
                                  }
                                foreach ($vuln_s['references']['metasploit'] as $wp_metas)
                                  {
                                    echo $lblue . "[i] Metasploit Module   : " . $fgreen . "http://www.metasploit.com/modules/" . $wp_metas . "\n";
                                  }
                                foreach ($vuln_s['references']['osvdb'] as $wp_osvdb)
                                  {
                                    echo $lblue . "[i] OSVDB Link          : " . $fgreen . "http://osvdb.org/" . $wp_osvdb . "\n";
                                  }
                                foreach ($vuln_s['references']['secunia'] as $wp_secu)
                                  {
                                    echo $lblue . "[i] Secunia Link        : " . $fgreen . "http://secunia.com/advisories/" . $wp_secu . "\n";
                                  }
                                foreach ($vuln_s['references']["url"] as $vuln_ref)
                                  {
                                    echo $lblue . "[i] Sebezhetoseg referenciaja      : " . $fgreen . $vuln_ref . "\n";
                                  }
                                echo "\n\n";
                              }
                          }
                      }
                    $reallink = $ipsl . $ip;
                    echo "\n\n";
                    echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
                    trim(fgets(STDIN, 1024));
                    goto scanlist;
                  }
                else
                  {
                    $reallink = $ipsl . $ip;
                    echo $red . "Nincs siker :( \n\n[!] Nem talaltunk WordPress-t az adott weboldalon";
                    echo "\n\n";
                    echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
                    trim(fgets(STDIN, 1024));
                    goto scanlist;
                  }
              }
            else
              {
                $reallink = $ipsl . $ip;
                echo $red . "Nincs siker :( \n\n[!] Nem talalhato WordPress az oldalon, Parancs befejezese!";
                echo "\n\n";
                echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
                trim(fgets(STDIN, 1024));
                goto scanlist;
              }
          }
        elseif ($scan == "12")
          {
            echo "\n$cln" . $lblue . $bold . "[+] Adatok betoltese ... \n";
            echo $blue . $bold . "[i] Vizsgalt webolalak:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : Erzekeny konyvtarak/fajlok keresese" . $cln;
            echo "\n\n";
            echo $bold . $blue . "\n[i] Parancs betoltese ....\n" . $cln;
            if (file_exists("crawl/admin.ini"))
              {
                echo $bold . $fgreen . "\n[^_^] Erzekeny fajlt talaltunk! Admin panel keresese [-]\n" . $cln;
                $crawllnk = file_get_contents("crawl/admin.ini");
                $crawls   = explode(',', $crawllnk);
                echo "\nURLs Loaded: " . count($crawls) . "\n\n";
                foreach ($crawls as $crawl)
                  {
                    $url    = $ipsl . $ip . "/" . $crawl;
                    $handle = curl_init($url);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($handle);
                    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                    if ($httpCode == 200)
                      {
                        echo $bold . $lblue . "\n\n[U] $url : " . $cln;
                        echo $bold . $fgreen . "Talalat!" . $cln;
                      }
                    elseif ($httpCode == 404)
                      {
                      }
                    else
                      {
                        echo $bold . $lblue . "\n\n[U] $url : " . $cln;
                        echo $bold . $yellow . "HTTP Valasz: " . $httpCode . $cln;
                      }
                    curl_close($handle);
                  }
              }
            else
              {
                echo "\n Nincs elerheto fajl, Parancs befejezese ....\n";
              }
            if (file_exists("crawl/backup.ini"))
              {
                echo "\n[-] Biztonsagi mentest talaltunk! [-]\n";
                $crawllnk = file_get_contents("crawl/backup.ini");
                $crawls   = explode(',', $crawllnk);
                echo "\nURLs Loaded: " . count($crawls) . "\n\n";
                foreach ($crawls as $crawl)
                  {
                    $url    = $ipsl . $ip . "/" . $crawl;
                    $handle = curl_init($url);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($handle);
                    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                    if ($httpCode == 200)
                      {
                        echo $bold . $lblue . "\n\n[U] $url : " . $cln;
                        echo $bold . $fgreen . "Talalat!" . $cln;
                      }
                    elseif ($httpCode == 404)
                      {
                      }
                    else
                      {
                        echo $bold . $lblue . "\n\n[U] $url : " . $cln;
                        echo $bold . $yellow . "HTTP Valasz: " . $httpCode . $cln;
                      }
                    curl_close($handle);
                  }
              }
            else
              {
                echo "\n Nem talaltunk biztonsagi mentest, Parancs befejezese ....\n";
              }
            if (file_exists("crawl/others.ini"))
              {
                echo "\n[-] Erzekeny konyvtarattalaltunk! Weboldal szkennelese [-]\n";
                $crawllnk = file_get_contents("crawl/others.ini");
                $crawls   = explode(',', $crawllnk);
                echo "\nURLs Loaded: " . count($crawls) . "\n\n";
                foreach ($crawls as $crawl)
                  {
                    $url    = $ipsl . $ip . "/" . $crawl;
                    $handle = curl_init($url);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($handle);
                    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                    if ($httpCode == 200)
                      {
                        echo $bold . $lblue . "\n\n[U] $url : " . $cln;
                        echo $bold . $fgreen . "Talalat!" . $cln;
                      }
                    elseif ($httpCode == 404)
                      {
                      }
                    else
                      {
                        echo $bold . $lblue . "\n\n[U] $url : " . $cln;
                        echo $bold . $yellow . "HTTP Valasz: " . $httpCode . $cln;
                      }
                    curl_close($handle);
                  }
              }
            else
              {
                echo "\n Nem talaltunk erzekeny konyvtarat, Parancs befejezese ....\n";
              }
          }
        elseif ($scan == "13")
          {
            $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Betoltes ... \n";
            echo $blue . $bold . "[i] Vizsgalt weboldal :\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Parancs : MX Adatok" . $cln;
            echo "\n\n";
            echo MXlookup($lwwww);
            echo "\n\n";
            echo $bold . $yellow . "[*] Teszt vegrehajtva. Nyomj entert a folytatashoz vagy ctrl + c -t a kilepeshez\n\n";
            trim(fgets(STDIN, 1024));
            goto scanlist;
          }
        elseif ($scan == 'U' || $scan == 'u')
          {
            echo "\n\n" . $bold . $yellow . "-[ Program frissitese]-\n\n" . $cln;
            echo $bold . "[i] Frissites betoltese .... \n" . $cln;
            $latestversion = readcontents("https://raw.githubusercontent.com/Tuhinshubhra/RED_HAWK/master/version.txt");
            echo $bold . $blue . "[C] Jelenlegi verzio: " . $rhversion . $cln;
            echo "\n" . $bold . $lblue . "[L] Legfrissebb verzio
            if ($latestversion > $rhversion)
              {
                echo $bold . $fgreen . "\n\n [U] Frissites elerheto \n\n" . $cln;
                echo $bold . $white . "    Link: https://github.com/cybetyar/webtesztprogram\n\n" . $cln;
              }

            elseif ($rhversion == $latestversion)
              {
                echo $bold . $fgreen . "\n[i] A legfrissebb verzio van meg neked. \n\n" . $cln;
              }
            else
              {
                echo $bold . $red . "\n[U] Valami nem jo :( Kerlek frissits manualisan! \n\n";
              }
          }
        elseif ($scan == "F" || $scan == "f"){
          echo "\n\e[91m\e[1m[+] Hibakereso [+]\n\n$cln";
          echo $bold . $blue . "[+] cURL modul vizsgalata ...\n";
          if (!extension_loaded('curl'))
            {
              echo $bold . $red . "[!] cURL modul nincs installalva! \n";
              echo $yellow . "[*] cURL telepitese (Sudo jogosultsag szukseges) \n" . $cln;
              system("sudo apt-get -qq --assume-yes install php-curl");
              echo $bold . $fgreen . "[i] cURL telepitve. \n";
            }
          else
            {
              echo $bold . $fgreen . "[i] cURL telepitve, nezzuk mi lehet meg a baj\n";
            }
          echo $bold . $blue . "[+] php-XML modul ellenorzese  ...\n";
          if (!extension_loaded('dom'))
            {
              echo $bold . $red . "[!] php-XML nincs telepitve ! \n";
              echo $yellow . "[*] php-XML telepitese (Sudo jogosultsag szukseges) \n" . $cln;
              system("sudo apt-get -qq --assume-yes install php-xml");
              echo $bold . $fgreen . "[i] DOM telepitve. \n";
            }
          else
            {
              echo $bold . $fgreen . "[i] php-XML telepitve van, minden keszen all ;) \n";
            }
          echo $bold . $fgreen . "[i] Hiba kijavitva! Kerlek inditsd ujra a programot \n";
          exit;
        }
        elseif ($scan == "A" || $scan == "a")
          {

            echo "\n$cln" . "$lblue" . "[+] Betoltes ... \n";
            echo "$blue" . "[i] Vizsgalt weboldal:\e[92m $ipsl" . "$ip \n";
            echo "\n\n";

            echo "\n$bold" . "$lblue" . "Alapadatok begyujtese \n";
            echo "====================\n";
            echo "\n\e[0m";

            $reallink = $ipsl . $ip;
            $srccd    = file_get_contents($reallink);
            $lwwww    = str_replace("www.", "", $ip);

            echo "\n$blue" . "[+] Weboldal neve: ";
            echo "\e[92m";
            echo getTitle($reallink);
            echo "\e[0m";


            $wip = gethostbyname($ip);
            echo "\n$blue" . "[+] IP cim: ";
            echo "\e[92m";
            echo $wip . "\n\e[0m";

            echo "$blue" . "[+] Szerver: ";
            WEBserver($reallink);
            echo "\n";

            echo "$blue" . "[+] CMS: \e[92m" . CMSdetect($reallink) . " \e[0m";

            echo "\n$blue" . "[+] Cloudflare: ";
            cloudflaredetect($reallink);

            echo "$blue" . "[+] Robots fajl:$cln ";
            robotsdottxt($reallink);
            echo "\n\n$cln";
            echo "\n\n$bold" . $lblue . "Whois adatok\n";
            echo "========================";
            echo "\n\n$cln";
            $urlwhois    = "http://api.hackertarget.com/whois/?q=" . $lwwww;
            $resultwhois = file_get_contents($urlwhois);
            echo "\t";
            echo $resultwhois;
            echo "\n\n$cln";

            echo "\n\n$bold" . $lblue . "Foldrajzi hely\n";
            echo "=========================";
            echo "\n\n$cln";
            $urlgip    = "http://api.hackertarget.com/geoip/?q=" . $lwwww;
            $resultgip = readcontents($urlgip);
            $geoips    = explode("\n", $resultgip);
            foreach ($geoips as $geoip)
              {
                echo $bold . $green . "[i]$cln $geoip \n";
              }
            echo "\n\n$cln";

            echo "\n\n$bold" . $lblue . "HTTP fejlec\n";
            echo "=======================";
            echo "\n\n$cln";
            gethttpheader($reallink);
            echo "\n\n";

            echo "\n\n$bold" . $lblue . "Nevszerver adatok(DNS)\n";
            echo "===================";
            echo "\n\n$cln";
            $urldlup    = "http://api.hackertarget.com/dnslookup/?q=" . $lwwww;
            $resultdlup = file_get_contents($urldlup);
            echo $resultdlup;
            echo "\n\n";

            echo "\n\n$bold" . $lblue . "Subnet kalkulator\n";
            echo "====================================";
            echo "\n\n$cln";
            $urlscal    = "http://api.hackertarget.com/subnetcalc/?q=" . $lwwww;
            $resultscal = file_get_contents($urlscal);
            echo $resultscal;
            echo "\n\n";

            echo "\n\n$bold" . $lblue . "Port zkenner\n";
            echo "============================";
            echo "\n\n$cln";
            $urlnmap    = "http://api.hackertarget.com/nmap/?q=" . $lwwww;
            $resultnmap = file_get_contents($urlnmap);
            echo $resultnmap;
            echo "\n";

            echo "\n\n$bold" . $lblue . "Altartomany vizsgalata\n";
            echo "==================================";
            echo "\n\n";
            $urlsd      = "http://api.hackertarget.com/hostsearch/?q=" . $lwwww;
            $resultsd   = file_get_contents($urlsd);
            $subdomains = trim($resultsd, "\n");
            $subdomains = explode("\n", $subdomains);
            unset($subdomains['0']);
            $sdcount = count($subdomains);
            echo "\n$blue" . "[i] Talalat :$cln " . $green . $sdcount . "\n\n$cln";
            foreach ($subdomains as $subdomain)
              {
                echo "[+] Altartomany:$cln $fgreen" . (str_replace(",", "\n\e[0m[-] IP:$cln $fgreen", $subdomain));
                echo "\n\n$cln";
              }
            echo "\n\n";

            echo "\n\n$bold" . $lblue . "IP cim vizsgalata\n";
            echo "==================================";
            echo "\n\n";
            $sth = 'http://domains.yougetsignal.com/domains.php';
            $ch  = curl_init($sth);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress=$ip&ket=");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            $resp  = curl_exec($ch);
            $resp  = str_replace("[", "", str_replace("]", "", str_replace("\"\"", "", str_replace(", ,", ",", str_replace("{", "", str_replace("{", "", str_replace("}", "", str_replace(", ", ",", str_replace(", ", ",", str_replace("'", "", str_replace("'", "", str_replace(":", ",", str_replace('"', '', $resp)))))))))))));
            $array = explode(",,", $resp);
            unset($array[0]);
            echo "\n$blue" . "[i] Talalat :$cln " . $green . count($array) . "\n\n$cln";
            foreach ($array as $izox)
              {
                echo "\n$blue" . "[#]$cln " . $fgreen . $izox . $cln;
                echo "\n$blue" . "[-] CMS:$cln $green";
                $cmsurl = "http://" . $izox;
                $cmssc  = file_get_contents($cmsurl);
                if (strpos($cmssc, '/wp-content/') !== false)
                  {
                    $tcms = "WordPress";
                  }
                else
                  {
                    if (strpos($cmssc, 'Joomla') !== false)
                      {
                        $tcms = "Joomla";
                      }
                    else
                      {
                        $drpurl = "http://" . $izox . "/misc/drupal.js";
                        $drpsc  = file_get_contents($drpurl);
                        if (strpos($drpsc, 'Drupal') !== false)
                          {
                            $tcms = "Drupal";
                          }
                        else
                          {
                            if (strpos($cmssc, '/skin/frontend/') !== false)
                              {
                                $tcms = "Magento";
                              }
                            else
                              {
                                $tcms = $red . "Could Not Detect$cln ";
                              }
                          }
                      }
                  }
                echo $tcms . "\n";
              }

            echo "\n\n";
            echo "\n\n$bold" . $lblue . "SQL sebezhetoseg\n";
            echo "===================================================$cln";
            echo "\n";
            $lulzurl = $ipsl . $ip;
            $html    = file_get_contents($lulzurl);
            $dom     = new DOMDocument;
            @$dom->loadHTML($html);
            $links = $dom->getElementsByTagName('a');
            $vlnk  = 0;
            foreach ($links as $link)
              {
                $lol = $link->getAttribute('href');
                if (strpos($lol, '?') !== false)
                  {
                    echo "\n$blue [#] " . $fgreen . $lol . "\n$cln";
                    echo $blue . " [-] SQL Error keresese: ";
                    $sqllist = file_get_contents('sqlerrors.ini');
                    $sqlist  = explode(',', $sqllist);
                    if (strpos($lol, '://') !== false)
                      {
                        $sqlurl = $lol . "'";
                      }
                    else
                      {
                        $sqlurl = $ipsl . $ip . "/" . $lol . "'";
                      }
                    $sqlsc = file_get_contents($sqlurl);
                    $sqlvn = "$red Not Found";
                    foreach ($sqlist as $sqli)
                      {
                        if (strpos($sqlsc, $sqli) !== false)
                            $sqlvn = "$green Found!";
                      }
                    echo $sqlvn;
                    echo "\n$cln";
                    echo "\n";
                    $vlnk++;
                  }
              }
            echo "\n\n$blue [+] URL-ek :" . $green . $vlnk;
            echo "\n\n";

            echo "\n\n$bold" . $lblue . "Fajl szkenner \n";
            echo "=============";
            echo "\n\n";
            echo "\nFunkciok:$cln";
            echo "\n\n$bold" . "69:$cln Alap funkcio \n";
            echo "\n$bold" . "Alapos funkcio \n\n";
csel:
            echo "Valassz (69/420): ";
            $ctype = trim(fgets(STDIN, 1024));
            if ($ctype == "420")
              {
                echo "\n\t -[ Alapos funkcio inditasa ]-\n";
                echo "\n\n";
                echo "\n Fajlok betoltese ....\n";
                if (file_exists("crawl/admin.ini"))
                  {
                    echo "\n[-] Admin panel keresese [-]\n";
                    $crawllnk = file_get_contents("crawl/admin.ini");
                    $crawls   = explode(',', $crawllnk);
                    echo "\nURLs Talalat: " . count($crawls) . "\n\n";
                    foreach ($crawls as $crawl)
                      {
                        $url    = $ipsl . $ip . "/" . $crawl;
                        $handle = curl_init($url);
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                        $response = curl_exec($handle);
                        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        if ($httpCode == 200)
                          {
                            echo "\n\n[U] $url : ";
                            echo "Siker!";
                          }
                        elseif ($httpCode == 404)
                          {
                          }
                        else
                          {
                            echo "\n\n[U] $url : ";
                            echo "HTTP Valasz: " . $httpCode;
                          }
                        curl_close($handle);
                      }
                  }
                else
                  {
                    echo "\n Fajl nem elerheto, Parancs bezarasa ....\n";
                  }
                if (file_exists("crawl/backup.ini"))
                  {
                    echo "\n[-] Biztonsagi mentes keresese [-]\n";
                    $crawllnk = file_get_contents("crawl/backup.ini");
                    $crawls   = explode(',', $crawllnk);
                    echo "\nURLs Talalat: " . count($crawls) . "\n\n";
                    foreach ($crawls as $crawl)
                      {
                        $url    = $ipsl . $ip . "/" . $crawl;
                        $handle = curl_init($url);
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                        $response = curl_exec($handle);
                        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        if ($httpCode == 200)
                          {
                            echo "\n\n[U] $url : ";
                            echo "Siker!";
                          }
                        elseif ($httpCode == 404)
                          {
                          }
                        else
                          {
                            echo "\n\n[U] $url : ";
                            echo "HTTP Valasz: " . $httpCode;
                          }
                        curl_close($handle);
                      }
                  }
                else
                  {
                    echo "\n Fajl nem elerheto, Parancs befejezese ....\n";
                  }
                if (file_exists("crawl/others.ini"))
                  {
                    echo "\n[-] Erzekeny fajl keresese [-]\n";
                    $crawllnk = file_get_contents("crawl/others.ini");
                    $crawls   = explode(',', $crawllnk);
                    echo "\nURLs Talalat: " . count($crawls) . "\n\n";
                    foreach ($crawls as $crawl)
                      {
                        $url    = $ipsl . $ip . "/" . $crawl;
                        $handle = curl_init($url);
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                        $response = curl_exec($handle);
                        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        if ($httpCode == 200)
                          {
                            echo "\n\n[U] $url : ";
                            echo "Siker!";
                          }
                        elseif ($httpCode == 404)
                          {
                          }
                        else
                          {
                            echo "\n\n[U] $url : ";
                            echo "Valasz: " . $httpCode;
                          }
                        curl_close($handle);
                      }
                  }
                else
                  {
                    echo "\n Fajl nem elerheto, Parancs befejezese....\n";
                  }
              }
            elseif ($ctype == "69")
              {
                echo "\n\t -[ Alap funkcio inditasa]-\n";
                echo "\n\n";
                echo "\n Fajlok betoltese....\n";
                if (file_exists("crawl/admin.ini"))
                  {
                    echo "\n[-] Admin panel keresese [-]\n";
                    $crawllnk = file_get_contents("crawl/admin.ini");
                    $crawls   = explode(',', $crawllnk);
                    echo "\nURLs Talalat: " . count($crawls) . "\n\n";
                    foreach ($crawls as $crawl)
                      {
                        $url    = $ipsl . $ip . "/" . $crawl;
                        $handle = curl_init($url);
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                        $response = curl_exec($handle);
                        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        if ($httpCode == 200)
                          {
                            echo "\n\n[U] $url : ";
                            echo "Siker!";
                          }
                        elseif ($httpCode == 404)
                          {
                          }
                        else
                          {
                            echo ".";
                          }
                        curl_close($handle);
                      }
                  }
                else
                  {
                    echo "\n Fajl nem elerheto, Parancs befejezese ....\n";
                  }
                if (file_exists("crawl/backup.ini"))
                  {
                    echo "\n[-] Biztonsagi mentes keresese [-]\n";
                    $crawllnk = file_get_contents("crawl/backup.ini");
                    $crawls   = explode(',', $crawllnk);
                    echo "\nURLs Talalat: " . count($crawls) . "\n\n";
                    foreach ($crawls as $crawl)
                      {
                        $url    = $ipsl . $ip . "/" . $crawl;
                        $handle = curl_init($url);
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                        $response = curl_exec($handle);
                        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        if ($httpCode == 200)
                          {
                            echo "\n\n[U] $url : ";
                            echo "Siker!";
                          }
                        elseif ($httpCode == 404)
                          {
                          }
                        curl_close($handle);
                      }
                  }
                else
                  {
                    echo "\n Fajl nem elerheto, Parancs befejezese ....\n";
                  }
                if (file_exists("crawl/others.ini"))
                  {
                    echo "\n[-] Erzekeny fajlok keresese [-]\n";
                    $crawllnk = file_get_contents("crawl/others.ini");
                    $crawls   = explode(',', $crawllnk);
                    echo "\nURLs Talalat: " . count($crawls) . "\n\n";
                    foreach ($crawls as $crawl)
                      {
                        $url    = $ipsl . $ip . "/" . $crawl;
                        $handle = curl_init($url);
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                        $response = curl_exec($handle);
                        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        if ($httpCode == 200)
                          {
                            echo "\n\n[U] $url : ";
                            echo "Siker!";
                          }
                        elseif ($httpCode == 404)
                          {
                          }
                        curl_close($handle);
                      }
                  }
                else
                  {
                    echo "\n Fajl nem elerheto, Parancs befejezese....\n";
                  }
              }
            else
              {
                goto csel;
              }
          }
      }
  }
?>

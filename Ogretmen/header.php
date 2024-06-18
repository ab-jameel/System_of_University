<nav class="navbar">
        <div class="hamburger-menu" id="hamburger-menu">
            &#9776;
        </div>
        <div class="menu-links" id="menu-links">
            <div class="p-1">
                <p class="border-bottom">Sistem Yönetimi</p>
                <a href="#">Kullanıcı Kılavuzu Yönetim İşlemleri</a>
            </div>
            <div>
                <p class="border-bottom">DİLEK ÖNERİ ŞİKAYET</p>
                <a href="#">Dilek, Öneri Veya Şikayet Oluştur</a>
            </div>
            <div class="ders-islemleri mb-0">
                <p class="border-bottom">ÖĞRENCİ BİLGİ SİSTEMİ</p>
                <div>
                    <p class="collapsible" id="ders-islemleri">> Ders İşlemleri </p>
                    <ul class="collapsible-content" id="egitim-katalogu">
                        <li class="ml-4"><a href="#">Eğitim Kataloğu</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <p class="border-bottom">AKADEMİK PERFORMANS BİLGİ SİSTEMİ</p>
                <a href="#">Bilgi Görüntüleme</a>
            </div>
            <div>
                <p class="border-bottom">Ölçme Değerlendirme</p>
                <a href="#">Sınavlarım</a>
            </div>
        </div>
        <div class="navbar-links">
            <button  class="btn btn-danger" onclick="logout()">Log Out</button>  
        </div>   <script>
        function logout() {
            window.location.href = '../logout.php';
        }
    </script>
    </nav>
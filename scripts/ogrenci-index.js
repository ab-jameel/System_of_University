document.addEventListener('DOMContentLoaded', function() {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const menuLinks = document.getElementById('menu-links');
    const dersIslemleri = document.getElementById('ders-islemleri');
    const egitimKatalogu = document.getElementById('egitim-katalogu');
    const teacherDiv = document.querySelector('.shortcut-container');

    hamburgerMenu.addEventListener('click', function() {
        document.body.classList.toggle('menu-open');
    });

    document.addEventListener('click', function(event) {
        const targetElement = event.target; 
        if (!targetElement.closest('#menu-links') && !targetElement.closest('#hamburger-menu') && document.body.classList.contains('menu-open')) {
            document.body.classList.remove('menu-open'); 
        }
    });

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            document.body.classList.add('scrolled');
        } else {
            document.body.classList.remove('scrolled');
        }
    });

    dersIslemleri.addEventListener('click', function() {
        if (egitimKatalogu.style.display === "none" || egitimKatalogu.style.display === "") {
            egitimKatalogu.style.display = "block";
        } else {
            egitimKatalogu.style.display = "none";
        }
    });
    $(document).ready(function(){
    $('#myTab a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
})

    const studentMenuLinks = document.querySelectorAll('.student-menu a');
    
    studentMenuLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); 
            console.log("text: " + link.textContent)
            console.log(ogrenciBilgisi);
            console.log(haftaİcerikleri);
            console.log(odev);
            console.log(DersiAlanDiger);
            console.log(Duyurular);
            console.log(vizeSiralamasi);
            console.log(finalSiralamasi);
            console.log(vizeOrtalama);
            console.log(finalOrtalama);

            

            if (link.textContent.trim() === 'Genel Bilgiler') {
                const donem = parseInt(ogrenciBilgisi.donem, 10);
                const mevsim = (donem % 2 === 0) ? 'Bahar' : 'Güz';
                teacherDiv.style.display = 'block';
                teacherDiv.innerHTML = `
                 <div class="class-info">
                        <div class="d-flex justify-content-between">
                            <p>${mevsim}</p>
                            <p>Durum Netleşmemiş</p>
                        </div>
                        <div class="d-flex justify-con  ztent-between">
                            <p>Mühendislik Fakültesi - Bilgisayar Mühendisliği Bölümü / ${ogrenciBilgisi.Ders_kodu} - ${ogrenciBilgisi.Ders_ismi} -</p>
                            <p><a href="#" class="text-decoration-none">Devamlı</a></p>
                        </div>
                    </div>
                    <div class="results border-top">
                    <table>
                        <thead class="border-bottom">
                            <tr>
                            
                                <th>Sınav Tipi</th>
                                <th>Ders Adı</th>
                                <th>Sınav Notu</th>
                                <th>Mazaret</th>
                                <th>Sınıf Sıralaması</th>
                                <th>Sınıf Ortalaması</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td>Ara Sınav</td>
                                <td>${ogrenciBilgisi.Ders_ismi}</td>
                                <td>${ogrenciBilgisi.Vize}</td>
                                <td>-</td>
                                <td>${vizeSiralamasi.sira}</td>
                                <td>${vizeOrtalama.vize_ortalamasi}</td>
                            </tr>
                            <tr>
                                <td>Final</td>
                                <td>${ogrenciBilgisi.Ders_ismi}</td>
                                <td>${ogrenciBilgisi.final}</td>
                                <td>-</td>
                                <td>${finalSiralamasi.sira}</td>
                                <td>${finalOrtalama.final_ortalamasi}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>

                    <div class="teacher mt-2 d-flex justify-content-between p-2">
                        <div class="d-flex">
                            <img class="profile-photo rounded-circle" src="../../../../Dosyalar/${ogrenciBilgisi.dosya_url}" alt="">
                            <p class="pl-4 mt-3">${ogrenciBilgisi.ad} ${ogrenciBilgisi.soyad}</p>
                        </div>
                        <div>
                            <p>Final Sonunda Oluşan Sınıf Ağırlıklı Not Ortalaması : - </p>
                            <p>Bütünleme Sonunda Oluşan Sınıf Ağırlıklı Not Ortalaması : -</p>
                        </div>
                    </div>
                `;
            } else if (link.textContent.trim() === 'Hafta İçerikleri') {
                teacherDiv.style.display = 'block';
                teacherDiv.innerHTML = `
                    <div class="mt-2 justify-content-between p-2 bg-light border rounded">
                        ${haftaİcerikleri.map(icerik => `
                            <div class="p-2 weekly-content-info d-flex justify-content-between border rounded">
                                <div class="">
                                    <p><span>İçerik Adı :</span> ${icerik.icerik_adi}</p>
                                    <p><span>İçerik Tipi :</span> ${icerik.icerik_tipi}</p>
                                    <p><span>Yayınlanma Tarihi :</span> ${icerik.tarih}</p>
                                </div>
                                <div class="">
                                    <div>
                                        <p><span>İçerik Açıklaması :</span></p>
                                        <div>
                                            <p>${icerik.aciklama}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-file">
                                <h5 class="border-bottom p-3">İçeriğe Bağlı Dosyalar</h5>
                                <div class="d-flex flex-column p-3">
                                    <div class="d-flex">
                                        <a href="../../../../Dosyalar/${icerik.dosya_url}">Görüntüle</a>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                `;
            }else if(link.textContent.trim() === 'Ödevler'){
                teacherDiv.style.display = 'block';
                teacherDiv.innerHTML = `
                <div>
                    <p class="border-bottom">Ödevler</p>
                    ${odev.map(odevler => `
                                    <div>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Cevaplandı</th>
                                                    <th>Tanım</th>
                                                    <th>Son Teslim</th>
                                                    <th>İşlemler</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>+</td>
                                                    <td>${odevler.aciklama}</td>
                                                    <td>${odevler.sonteslim}</td>
                                                    <td>
                                                        <div class="">
                                                            <a href="../../../../Dosyalar/${odevler.dosya_url}"><button>gör</button></a>
                                                            <button onclick="showUploadForm(${odevler.odev_id})">Yükle</button>
                                                            <button 
                                                                ${odevler.ogrenciteslim 
                                                                    ? `onclick="window.location.href='../../../../Dosyalar/${odevler.ogrenciteslim}'"`
                                                                    : 'disabled'
                                                                }
                                                            >
                                                                teslim
                                                            </button>
                                                        </div>
                                                        <div id="upload-form-${odevler.odev_id}" style="display:none;">
                                                            <form method="post" enctype="multipart/form-data" action="upload.php">
                                                                <input type="hidden" name="odev_id" value="${odevler.odev_id}">
                                                                <input type="file" name="file">
                                                                <button type="submit">Yükle</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                          </tbody>
                                        </table>
                                        `).join('')}
                                    </div>
                `;
            }else if(link.textContent.trim() === "Dersi Alan Diğer Öğrenciler"){
                teacherDiv.style.display = 'block';
                teacherDiv.innerHTML = `
                <div>
                    <p>Dersi Alan Diğer Öğrenciler</p>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Resim</th>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                </tr>
                            </thead>
                            <tbody>
                            ${DersiAlanDiger.map(ogr => `
                                <tr>
                                    <td>
                                        <img class="profile-photo rounded-circle" src="../../../../Dosyalar/${ogr.dosya_url}" alt="">
                                    </td>
                                    <td>
                                        ${ogr.ad}
                                    </td>
                                    <td>
                                    ${ogr.soyad}
                                    </td>
                                </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
                `
            }else if(link.textContent.trim() === "Değerlendirme Sistemi"){
                teacherDiv.style.display = 'block';
                teacherDiv.innerHTML = `
                    <div>
                        <div> 
                                <p>Değerlendirme Sistemi</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Sınav Tipi</th>
                                            <th>Sınav Adı</th>
                                            <th>Sınav Yüzdesi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ara Sınav</td>
                                            <td>Vize</td>
                                            <td>40</td>
                                        </tr>
                                        <tr>
                                            <td>Final Sınavı</td>
                                            <td>Final</td>
                                            <td>60</td>
                                        </tr>
                                        <tr>
                                            <td>Bütünleme Sınavı</td>
                                            <td>Bütünleme</td>
                                            <td>60</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <!-- another table-->
                        <div class="mt-5"> 
                                <p class="border-bottom">Not Sistemi - Önlisans - Lisans Not sistemi</p>
                                <p>Not Sistemi Limit Değerleri</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Değer Tipi</th>
                                            <th>Min Değer</th>
                                            <th>Max Değer</th>
                                            <th>Değer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Yıl İçi Oranı</td>
                                            <td>40,000</td>
                                            <td>40,000</td>
                                            <td>KIRK</td>
                                        </tr>

                                        <tr>
                                            <td>Yıl Sonu Sınav Limiti</td>
                                            <td>50,000</td>
                                            <td>50,000</td>
                                            <td>DÖNEM_SONU_SINAVINDAN_50_ALAMAYAN_BAŞARISIZDIR</td>
                                        </tr>

                                        <tr>
                                            <td>Yetersizlik Durumu</td>
                                            <td>0,000</td>
                                            <td>0,000</td>
                                            <td>Devamsiz;YSSL;YSSL;BNAL;BNAL</td>
                                        </tr>

                                        <tr>
                                            <td>Yetersizlik Durumları Harf Not Karşılıkları</td>
                                            <td>0,000</td>
                                            <td>0,000</td>
                                            <td>DS;FF;FD;FD;FF</td>
                                        </tr>

                                        <tr>
                                            <td>Başarı notu alt limiti</td>
                                            <td>0,000</td>
                                            <td>0,000</td>
                                            <td>ALTMIŞ</td>
                                        </tr>
                                        <tr>
                                            <td>Bütünlemeye Girecek Harf Notlar</td>
                                            <td>0,000</td>
                                            <td>0,000</td>
                                            <td>FF;FD;YS</td>
                                        </tr>

                                    </tbody>
                                </table>
                        </div>
                        <!-- end of another table -->

                        <!-- another table-->
                        <div class="mt-5"> 
                        <p>Harf Not Sistemi</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Puan</th>
                                    <th>Puan Tipi</th>
                                    <th>Başarı Durumu</th>
                                    <th>Min Başarı Puanı</th>
                                    <th>4Lük Sistem Karşılığı</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>AA</td>
                                    <td>HBN</td>
                                    <td>Başarılı</td>
                                    <td>90</td>
                                    <td>4,00</td>
                                </tr>
                                <tr>
                                    <td>BA</td>
                                    <td>HBN</td>
                                    <td>Başarılı</td>
                                    <td>85</td>
                                    <td>3,50</td>
                                </tr>
                                <tr>
                                    <td>BB</td>
                                    <td>HBN</td>
                                    <td>Başarılı</td>
                                    <td>80</td>
                                    <td>3,00</td>
                                </tr>
                                <tr>
                                    <td>CB</td>
                                    <td>HBN</td>
                                    <td>Başarılı</td>
                                    <td>70</td>
                                    <td>2,50</td>
                                </tr>
                                <tr>
                                    <td>CC</td>
                                    <td>HBN</td>
                                    <td>Başarılı</td>
                                    <td>60</td>
                                    <td>2,00</td>
                                </tr>
                                <tr>
                                    <td>DC</td>
                                    <td>HBN</td>
                                    <td>Koşullu Başarılı</td>
                                    <td>55</td>
                                    <td>1,50</td>
                                </tr>
                                <tr>
                                    <td>DD</td>
                                    <td>HBN</td>
                                    <td>Koşullu Başarılı</td>
                                    <td>50</td>
                                    <td>1,00</td>
                                </tr>
                                <tr>
                                    <td>FD</td>
                                    <td>HBN</td>
                                    <td>Başarısız</td>
                                    <td>40</td>
                                    <td>0,50</td>
                                </tr>
                                <tr>
                                    <td>FF</td>
                                    <td>HBN</td>
                                    <td>Başarısız</td>
                                    <td>0</td>
                                    <td>0,00</td>
                                </tr>
                                <tr>
                                    <td>YE</td>
                                    <td>HBN</td>
                                    <td>Başarılı</td>
                                    <td>60</td>
                                    <td>0,00</td>
                                </tr>
                                <tr>
                                    <td>YS</td>
                                    <td>HBN</td>
                                    <td>Başarısız</td>
                                    <td>0</td>
                                    <td>0,00</td>
                                </tr>
                                <tr>
                                    <td>DS</td>
                                    <td>HBN</td>
                                    <td>Devamsız</td>
                                    <td>0</td>
                                    <td>0,00</td>
                                </tr>
                            </tbody>
                        </table>
                </div>

                        <!-- end of another table -->
                    </div>
                `;
                }else if(link.textContent.trim() === "Duyurular"){
                teacherDiv.style.display = 'block';
                teacherDiv.innerHTML = `
                <div>
                    <table>
                            <thead>
                                <tr>
                                    <th>Tarih</th>
                                    <th>Duyuru Başlığı</th>
                                    <th>İçerik</th>
                                    <th>Dosya</th>
                                </tr>
                            </thead>
                            <tbody>
                             ${Duyurular.map(Duyuru => `
                                <tr>
                                    <td>${Duyuru.aciklama_saati}</td>
                                    <td>${Duyuru.baslik}</td>
                                    <td>${Duyuru.aciklama}</td>
                                    <td class="">
                                       <a href="../../../../Dosyalar/${Duyuru.dosya_url}"><button class="ml-3">d</button></a>
                                    </td>
                                </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                `;
            }else{
                teacherDiv.style.display = 'block';
                teacherDiv.innerHTML = '';
            }
        });
    });
});
function showUploadForm(odevId) {
    document.getElementById(`upload-form-${odevId}`).style.display = 'block';
}


@extends('layout.default')
@section('topMenu')
    @include('layout.menu')
@endsection
@section('bottomMenu')
    @include('layout.bottomMenu')
@endsection
@section('content')
    <div class="main mb-5">
        <div id="" class="carousel slide" data-ride="carousel" data-pause="false" data-interval="8000">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('/images/foto/Dobris-24.jpg') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('/images/foto/Dobris-19.jpg') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('/images/foto/Dobris-27.jpg') }}" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('/images/foto/Dobris-39.jpg') }}" alt="Fourth slide">
                </div>
            </div>
        </div>
        <div class="container-xl">
            <a class="anchor" id="nabidka-dne" style="top: -100px;"></a>
            <div class="mt-3 mb-5" id="app">
                <h1>Nabídka dne</h1>
                <today-menu></today-menu>
            </div>
            <nav class="navbar navbar-divider bg-dark">
                <img class="navbar-brand position-absolute kocka" src="{{ asset('images/logo.png') }}" style="width: 100px;">
            </nav>
            <a class="anchor" id="menu"></a>
            <div class="mt-3">
                <h1>Stálé menu</h1>
                <div class="row">
                    <div class="col-md-6 mb-5 pb-3">

                        <h3>Polévky</h3>
                        <ul class=leaders>
                            <li><span>Silná česnečka s krutony</span><span>39 Kč</span></li>
                            <li><span>Dle denní nabídky</span><span>39 Kč</span></li>
                            <h3>Něco k pivu</h3>
                            <li><span>1 ks Utopenec, rozpečený chléb</span><span>65 Kč</span></li>
                            <li><span>120g Domácí nakládaný hermelín, rozpečený chléb</span><span>125 Kč</span></li>
                            <li><span>1 ks Pikantní topinka s kuřecím masem a sýrem</span><span>115 Kč</span></li>
                            <li><span>150g Grilovaný bůček s chlebem, jablečným křenem a hořčicí</span><span>105 Kč</span></li>
                            <li><span>150g Bramborové chipsy s kořením a tymiánem</span><span>60 Kč</span></li>
                            <li><span>200g Cibulové kroužky v pivním těstíčku</span><span>90 Kč</span></li>
                            <li><span>100g Smažené Jalapeño papričky s čedarem</span><span>100 Kč</span></li>
                            <li><span>100g Tlačenka s octem a cibulí, chléb</span><span>65 Kč</span></li>
                            <li><span>1ks Klobása, rozpečený chléb, křen, hořčice</span><span>75 Kč</span></li>
                        </ul>

                        <h3>Bezmasá jídla</h3>
                        <ul class=leaders>
                            <li><span>120g Smažený sýr (eidam)</span><span>85 Kč</span></li>
                            <li><span>120g Smažený Hermelín</span><span>90 Kč</span></li>
                            <li><span>300g Zapečená cuketa plněná zeleninovou směsí a rajčaty</span><span>150 Kč</span></li>
                        </ul>

                        <h3>Hlavní jídla</h3>
                        <ul class=leaders>
                            <li><span>150g Svíčková na smetaně, karlovarský knedlík, brusinky</span><span>160 Kč</span></li>
                            <li><span>180g Filet z lososa na bylinkovém másle</span><span>220 Kč</span></li>
                            <li><span>150g Kuřecí stripsy</span><span>145 Kč</span></li>
                            <li><span>250g Pikantní kuřecí křidélka a paličky</span><span>155 Kč</span></li>
                            <li><span>150g Smažený kuřecí řízek</span><span>135 Kč</span></li>
                            <li><span>200g Kuřecí prso s bylinkovým máslem</span><span>170 Kč</span></li>
                            <li><span>150g Kuřecí řízek „Křupan“</span><span>140 Kč</span></li>
                            <li><span>150g Pikantní vepřová směs</span><span>140 Kč</span></li>
                            <li><span>200g Marinovaná krkovička</span><span>145 Kč</span></li>
                            <li><span>800g Pečené vepřové koleno</span><span>240 Kč</span></li>
                            <li><span>900g Marinovaná vepřová žebra v BBQ omáčce</span><span>360 Kč</span></li>
                            <li><span>200g Filírovaná vepřová panenka s pepřovou omáčkou</span><span>240 Kč</span></li>
                            <li><span>250g Boloňské špagety</span><span>150 Kč</span></li>
                            <li><span>200g Hovězí steak Ball tip s restovanými žampiony a slaninou</span><span>260 Kč</span></li>
                            <li><span>150g Hovězí burger, hranolky</span><span>170 Kč</span></li>
                        </ul>
                        <h3>Saláty</h3>
                        <ul class=leaders>
                            <li><span>200g Řecký salát</span><span>75 Kč</span></li>
                            <li><span>300g Salát s kuřecím masem, balkánským sýrem a bylinkovým dipem</span><span>155 Kč</span></li>
                            <li><span>300g Caesar salát s krutony a slaninou</span><span>170 Kč</span></li>
                            <li><span>300g Salát z trhaných listů s grilovanými kousky lososa a avokádovým dipem</span><span>230 Kč</span></li>
                        </ul>
                    </div>
                    <div class="col-md-6 mb-5 pb-3">



                        <h3>Omáčky</h3>
                        <ul class=leaders>
                            <li><span>70g Domácí tatarka</span><span>20 Kč</span></li>
                            <li><span>70g Pepřová omáčka</span><span>25 Kč</span></li>
                            <li><span>70g BBQ</span><span>25 Kč</span></li>
                            <li><span>70g Sýrová</span><span>25 Kč</span></li>
                            <li><span>70g Bylinkový dip</span><span>20 Kč</span></li>
                            <li><span>70g Kečup</span><span>15 Kč</span></li>
                        </ul>


                        <h3>Přílohy</h3>
                        <ul class=leaders>
                            <li><span>150g Hranolky</span><span>35 Kč</span></li>
                            <li><span>150g Domácí krokety</span><span>35 Kč</span></li>
                            <li><span>150g Opečené brambory</span><span>40 Kč</span></li>
                            <li><span>150g Šťouchané brambory se slaninou a jarní cibulkou</span><span>50 Kč</span></li>
                            <li><span>150g Rýže</span><span>35 Kč</span></li>
                            <li><span>50g Pečivo</span><span>5 Kč</span></li>
                        </ul>

                        <h3>Dezerty</h3>
                        <ul class=leaders>
                            <li><span>1ks Cheesecake</span><span>90 Kč</span></li>
                            <li><span>3ks Lívanečky s ovocem a omáčkou z lesních plodů, zakysaná smetana</span><span>75 Kč</span></li>
                        </ul>
                        <img src="{{ asset('images/foto/Mobil1.JPG') }}" style="width: 100%"/>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-divider bg-dark">
                <img class="navbar-brand position-absolute kocka" src="{{ asset('images/logo.png') }}" style="width: 100px;">
            </nav>
            <a class="anchor" id="fotogalerie"></a>
            <div class="mt-3">
                <h1>Fotogalerie</h1>
                <div class="row">
                    @for($i=1; $i<23; $i++)
                        <div class="col-md-6">
                            <img src="/images/photogallery/placeholder.png" data-src="/images/photogallery/{{ $i }}.jpg" class="w-100 lazy" alt="Tankovna modrá kočka foto"/>
                        </div>
                    @endfor
                </div>
            </div>
            <a class="anchor" id="kontakt"></a>
            <div class="mt-4">

                <div class="row">

                    <div class="col-lg-6 text-center">
                        <h1>Kontakt</h1>
                        <div class=" text-center">
                            <div>Tel: +420 737 073 003</div>
                            <div>E-mail: info@kockadobris.cz</div>

                            <div class="mt-2">Školní 36 (Sportovní hala)<br/>263 01 Dobříš<br/>Česká republika</div>
                            <div class="mt-2">IČO: 616 56 852<br/>DIČ: CZ7811281115</div>
                        </div>

                    </div>
                    <div class="col-lg-6 text-center">
                        <h1>Otevírací doba</h1>
                        <div><strong>Pondělí</strong> 10:30 - 22:00</div>
                        <div><strong>Úterý</strong> 10:30 - 22:00</div>
                        <div><strong>Středa</strong> 10:30 - 22:00</div>
                        <div><strong>Čtvrtek</strong> 10:30 - 22:00</div>
                        <div><strong>Pátek</strong> 10:30 - 23:00</div>
                        <div><strong>Sobota</strong> 11:00 - 23:00</div>
                        <div><strong>Neděle</strong> 10:30 - 22:00</div>
                    </div>
                    <div class="col-12">
                        <h1>&nbsp;</h1>
                        <div id="mapa" class="w-100" style="height:400px;"></div>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="{{ asset("js/app.js") }}"></script>
    <script src="https://api.mapy.cz/loader.js"></script>
    <script>Loader.load()</script>
    <script type="text/javascript">
        var stred = SMap.Coords.fromWGS84(14.1738597, 49.7779228);
        var mapa = new SMap(JAK.gel("mapa"), stred, 15);
        mapa.addDefaultLayer(SMap.DEF_BASE).enable();
        mapa.addDefaultControls();

        var layer = new SMap.Layer.Marker();
        mapa.addLayer(layer);
        layer.enable();


        var marker = new SMap.Marker(stred, "myMarker");
        layer.addMarker(marker);

    </script>
@endsection

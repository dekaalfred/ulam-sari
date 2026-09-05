<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // ===== ANEKA IKAN =====
            ['name' => 'Gurame Goreng', 'desc' => 'Gurame segar pilihan digoreng garing dengan bumbu rempah khas Sunda.', 'cat' => 'Aneka Ikan', 'image' => 'images/gurame.png'],
            ['name' => 'Gurame Kuah Acar', 'desc' => 'Gurame segar pilihan dimasak dalam kuah acar yang asam dan pedas.', 'cat' => 'Aneka Ikan', 'image' => 'images/gurame acar.png'],
            ['name' => 'Nila Goreng', 'desc' => 'Ikan nila bumbu kuning digoreng garing di luar, lembut di dalam.', 'cat' => 'Aneka Ikan', 'image' => 'images/nila grng.png'],
            ['name' => 'Nila Acar', 'desc' => 'Ikan nila segar disiram bumbu acar kuning gurih dengan rasa asam dan segar.', 'cat' => 'Aneka Ikan', 'image' => 'images/nila acar.png'],
            ['name' => 'Lele Goreng', 'desc' => 'Ikan lele segar digoreng garing dengan bumbu kuning rempah pilihan.', 'cat' => 'Aneka Ikan', 'image' => 'images/lele.png'],
            ['name' => 'Lele Kuah Acar', 'desc' => 'Ikan lele disajikan dengan kuah acar kuning segar dan bumbu rempah.', 'cat' => 'Aneka Ikan', 'image' => 'images/lele kuah.png'],
            ['name' => 'Patin Kuah Acar', 'desc' => 'Ikan patin segar disajikan dengan kuah acar kuning yang gurih segar.', 'cat' => 'Aneka Ikan', 'image' => 'images/patin kuah.png'],
            ['name' => 'Lembutan Goreng', 'desc' => 'Ikan lembutan segar digoreng garing dengan bumbu rempah tradisional.', 'cat' => 'Aneka Ikan', 'image' => 'images/lembutan.png'],
            ['name' => 'Pepes Ikan Nila', 'desc' => 'Ikan nila dibungkus daun pisang dengan bumbu rempah kukus khas.', 'cat' => 'Aneka Ikan', 'image' => 'images/pepes.png'],

            // ===== ANEKA AYAM =====
            ['name' => 'Ayam Negri Goreng Laos', 'desc' => 'Ayam negri digoreng dengan bumbu laos yang gurih dan harum rempah', 'cat' => 'Aneka Ayam', 'image' => 'images/ayam laos.png'],
            ['name' => 'Ayam Negri Goreng Balado', 'desc' => 'Ayam negri goreng dengan sambal balado merah pedas yang menggugah', 'cat' => 'Aneka Ayam', 'image' => 'images/ayam balado.png'],
            ['name' => 'Ayam Kampung Goreng', 'desc' => 'Ayam kampung pilihan digoreng garing dengan bumbu rempah tradisional', 'cat' => 'Aneka Ayam', 'image' => 'images/ayam kampung (2).png'],
            ['name' => 'Ayam Negri/Kampung Bakar', 'desc' => 'Ayam negri dibakar dengan bumbu kecap manis dan rempah pilihan', 'cat' => 'Aneka Ayam', 'image' => 'images/bakar kp.png'],
            ['name' => 'Pepes Ayam Kampung', 'desc' => 'Ayam kampung dibungkus daun pisang dengan bumbu rempah kukus harum', 'cat' => 'Aneka Ayam', 'image' => 'images/pepes ikan.png'],

            // ===== SAYURAN & TUMISAN =====
            ['name' => 'Kangkung', 'desc' => 'Kangkung segar ditumis dengan bumbu bawang putih dan cabai pilihan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/kangkung.png'],
            ['name' => 'Urab', 'desc' => 'Sayuran segar dicampur dengan kelapa parut berbumbu khas jawa', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/urab.png'],
            ['name' => 'Buncis', 'desc' => 'Buncis segar ditumis dengan bumbu bawang merah dan cabai pilihan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/buncis.png'],
            ['name' => 'Putren', 'desc' => 'Putren segar ditumis dengan bumbu rempah tradisional yang gurih', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/putren.png'],
            ['name' => 'Kulit Melinjo', 'desc' => 'Kulit melinjo digoreng garing dengan bumbu bawang putih dan garam', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/kulit melinjo.png'],
            ['name' => 'Tahu', 'desc' => 'Tahu pilihan digoreng garing atau disemur dengan bumbu khas rumahan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/tahu.png'],
            ['name' => 'Tempe Nyemek', 'desc' => 'Tempe dimasak nyemek dengan bumbu kecap manis dan cabai yang gurih', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/tempe nyemek.png'],
            ['name' => 'Kering Tempe', 'desc' => 'Tempe diiris tipis digoreng kering dengan kacang tanah dan cabai', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/kering tempe.png'],
            ['name' => 'Terong Balado', 'desc' => 'Terong ungu digoreng dan dilumuri sambal balado merah yang pedas', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/terong balado.png'],
            ['name' => 'Terong Cabai Hijau', 'desc' => 'Terong ungu ditumis dengan cabai hijau segar dan bumbu rempah', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/terong hijau.png'],
            ['name' => 'Kare Kentang', 'desc' => 'Kentang dimasak kuah dengan santan dan rempah kuning yang gurih', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/rawa kentang.png'],
            ['name' => 'Kentang Cabai Hijau', 'desc' => 'Kentang ditumis dengan cabai hijau segar dan bumbu rempah pilihan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/kentang hijau.png'],
            ['name' => 'Pakis', 'desc' => 'Sayur pakis segar ditumis dengan bumbu bawang dan terasi pilihan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/pakis.png'],
            ['name' => 'Pare', 'desc' => 'Pare segar ditumis dengan bumbu rempah yang mengurangi rasa pahit', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/pare.png'],
            ['name' => 'Buntil Daun Singkong', 'desc' => 'Daun singkong muda dibungkus isi kelapa parut berbumbu rempah', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/buntil.png'],
            ['name' => 'Mie Kanyel', 'desc' => 'Mie kanyel dimasak dengan bumbu rempah tradisional yang gurih', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/mie kanyel.png'],
            ['name' => 'Mie Goreng', 'desc' => 'Mie digoreng dengan bumbu kecap dan sayuran segar pilihan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/mie goreng.png'],
            ['name' => 'Bihun Goreng', 'desc' => 'Bihun digoreng dengan bumbu kecap dan sayuran segar pilihan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/bihun goreng.png'],
            ['name' => 'Jamur Tiram', 'desc' => 'Jamur tiram segar ditumis dengan bumbu bawang dan rempah pilihan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/jamur tiram.png'],
            ['name' => 'Genjer', 'desc' => 'Genjer segar ditumis dengan bumbu terasi dan bawang putih pilihan', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/genjer.png'],
            ['name' => 'Sup / Sayur Bening', 'desc' => 'Sayur ini segar dimasak bening dengan kuah kaldu yang gurih dan segar', 'cat' => 'Sayuran & Tumisan', 'image' => 'images/sayur bening.png'],

            // ===== MENU LAINNYA =====
            ['name' => 'Kikil', 'desc' => 'Kikil sapi empuk dimasak dengan bumbu kecap manis gurih', 'cat' => 'Menu Lainnya', 'image' => 'images/kikil.png'],
            ['name' => 'Telur Dadar', 'desc' => 'Telur ayam didadar tipis dengan bumbu bawang dan rempah pilihan', 'cat' => 'Menu Lainnya', 'image' => 'images/telor dadar.png'],
            ['name' => 'Telur Balado', 'desc' => 'Telur ayam rebus digoreng dan dilumuri sambal balado merah pedas', 'cat' => 'Menu Lainnya', 'image' => 'images/telor balado.png'],
            ['name' => 'Perkedel', 'desc' => 'Perkedel kentang goreng renyah dengan campuran daging dan rempah', 'cat' => 'Menu Lainnya', 'image' => 'images/perkedel.png'],
        ];

        foreach ($items as $item) {
            Menu::updateOrCreate(
                ['name' => $item['name']], // kunci pencocokan, biar aman dijalankan berkali-kali
                [
                    'desc'   => $item['desc'],
                    'cat'    => $item['cat'],
                    'image'  => $item['image'],
                    'price'  => 0, // isi manual nanti lewat modal admin
                    'status' => 'tersedia',
                ]
            );
        }
    }
}
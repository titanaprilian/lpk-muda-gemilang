<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi pesan kesalahan standar yang digunakan oleh
    | kelas validator. Beberapa aturan ini memiliki banyak versi seperti
    | aturan ukuran. Silakan sesuaikan pesan-pesan ini di sini.
    |
    */

    "accepted" => ":Attribute harus diterima.",
    "accepted_if" => ":Attribute harus diterima ketika :other berisi :value.",
    "active_url" => ":Attribute bukan URL yang valid.",
    "after" => ":Attribute harus berisi tanggal setelah :date.",
    "after_or_equal" =>
        ":Attribute harus berisi tanggal setelah atau sama dengan :date.",
    "alpha" => ":Attribute hanya boleh berisi huruf.",
    "alpha_dash" =>
        ":Attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.",
    "alpha_num" => ":Attribute hanya boleh berisi huruf dan angka.",
    "any_of" => ":Attribute yang dipilih tidak valid.",
    "array" => ":Attribute harus berupa array.",
    "ascii" =>
        ":Attribute hanya boleh berisi karakter dan simbol alfanumerik single-byte.",
    "before" => ":Attribute harus berisi tanggal sebelum :date.",
    "before_or_equal" =>
        ":Attribute harus berisi tanggal sebelum atau sama dengan :date.",
    "between" => [
        "array" => ":Attribute harus memiliki :min sampai :max anggota.",
        "file" =>
            ":Attribute harus berukuran antara :min sampai :max kilobita.",
        "numeric" => ":Attribute harus bernilai antara :min sampai :max.",
        "string" => ":Attribute harus berisi antara :min sampai :max karakter.",
    ],
    "boolean" => ":Attribute harus bernilai true atau false.",
    "can" => ":Attribute berisi nilai yang tidak sah.",
    "confirmed" => "Konfirmasi :attribute tidak cocok.",
    "contains" => ":Attribute kehilangan nilai yang diwajibkan.",
    "current_password" => "Kata sandi salah.",
    "date" => ":Attribute bukan tanggal yang valid.",
    "date_equals" => ":Attribute harus berisi tanggal yang sama dengan :date.",
    "date_format" => ":Attribute tidak cocok dengan format :format.",
    "decimal" => ":Attribute harus memiliki :decimal tempat desimal.",
    "declined" => ":Attribute harus ditolak.",
    "declined_if" => ":Attribute harus ditolak ketika :other bernilai :value.",
    "different" => ":Attribute dan :other harus berbeda.",
    "digits" => ":Attribute harus terdiri dari :digits digit.",
    "digits_between" => ":Attribute harus terdiri dari :min sampai :max digit.",
    "dimensions" => ":Attribute tidak memiliki dimensi gambar yang valid.",
    "distinct" => ":Attribute memiliki nilai yang duplikat.",
    "doesnt_contain" =>
        ":Attribute tidak boleh mengandung salah satu dari berikut: :values.",
    "doesnt_end_with" =>
        ":Attribute tidak boleh diakhiri dengan salah satu dari berikut: :values.",
    "doesnt_start_with" =>
        ":Attribute tidak boleh diawali dengan salah satu dari berikut: :values.",
    "email" => ":Attribute harus berupa alamat email yang valid.",
    "encoding" => ":Attribute harus dienkoding dengan :encoding.",
    "ends_with" =>
        ":Attribute harus diakhiri salah satu dari berikut: :values.",
    "enum" => ":Attribute yang dipilih tidak valid.",
    "exists" => ":Attribute yang dipilih tidak valid.",
    "extensions" =>
        ":Attribute harus memiliki salah satu ekstensi berikut: :values.",
    "file" => ":Attribute harus berupa sebuah berkas.",
    "filled" => ":Attribute harus memiliki nilai.",
    "gt" => [
        "array" => ":Attribute harus memiliki lebih dari :value anggota.",
        "file" => ":Attribute harus berukuran lebih dari :value kilobita.",
        "numeric" => ":Attribute harus bernilai lebih dari :value.",
        "string" => ":Attribute harus berisi lebih dari :value karakter.",
    ],
    "gte" => [
        "array" => ":Attribute harus memiliki :value anggota atau lebih.",
        "file" =>
            ":Attribute harus berukuran lebih dari atau sama dengan :value kilobita.",
        "numeric" =>
            ":Attribute harus bernilai lebih dari atau sama dengan :value.",
        "string" =>
            ":Attribute harus berisi lebih dari atau sama dengan :value karakter.",
    ],
    "hex_color" => ":Attribute harus berupa warna heksadesimal yang valid.",
    "image" => ":Attribute harus berupa gambar.",
    "in" => ":Attribute yang dipilih tidak valid.",
    "in_array" => ":Attribute tidak ada di dalam :other.",
    "in_array_keys" =>
        ":Attribute harus mengandung setidaknya satu dari kunci berikut: :values.",
    "integer" => ":Attribute harus berupa bilangan bulat.",
    "ip" => ":Attribute harus berupa alamat IP yang valid.",
    "ipv4" => ":Attribute harus berupa alamat IPv4 yang valid.",
    "ipv6" => ":Attribute harus berupa alamat IPv6 yang valid.",
    "json" => ":Attribute harus berupa string JSON yang valid.",
    "list" => ":Attribute harus berupa daftar.",
    "lowercase" => ":Attribute harus berupa huruf kecil.",
    "lt" => [
        "array" => ":Attribute harus memiliki kurang dari :value anggota.",
        "file" => ":Attribute harus berukuran kurang dari :value kilobita.",
        "numeric" => ":Attribute harus bernilai kurang dari :value.",
        "string" => ":Attribute harus berisi kurang dari :value karakter.",
    ],
    "lte" => [
        "array" => ":Attribute tidak boleh memiliki lebih dari :value anggota.",
        "file" =>
            ":Attribute harus berukuran kurang dari atau sama dengan :value kilobita.",
        "numeric" =>
            ":Attribute harus bernilai kurang dari atau sama dengan :value.",
        "string" =>
            ":Attribute harus berisi kurang dari atau sama dengan :value karakter.",
    ],
    "mac_address" => ":Attribute harus berupa alamat MAC yang valid.",
    "max" => [
        "array" => ":Attribute tidak boleh memiliki lebih dari :max anggota.",
        "file" => ":Attribute tidak boleh lebih dari :max kilobita.",
        "numeric" => ":Attribute tidak boleh lebih dari :max.",
        "string" => ":Attribute tidak boleh lebih dari :max karakter.",
    ],
    "max_digits" => ":Attribute tidak boleh memiliki lebih dari :max digit.",
    "mimes" => ":Attribute harus berupa berkas berjenis: :values.",
    "mimetypes" => ":Attribute harus berupa berkas berjenis: :values.",
    "min" => [
        "array" => ":Attribute harus memiliki minimal :min anggota.",
        "file" => ":Attribute harus berukuran minimal :min kilobita.",
        "numeric" => ":Attribute harus bernilai minimal :min.",
        "string" => ":Attribute harus berisi minimal :min karakter.",
    ],
    "min_digits" => ":Attribute harus memiliki minimal :min digit.",
    "missing" => ":Attribute harus hilang (tidak ada).",
    "missing_if" => ":Attribute harus hilang ketika :other bernilai :value.",
    "missing_unless" =>
        ":Attribute harus hilang kecuali :other bernilai :value.",
    "missing_with" => ":Attribute harus hilang ketika :values ada.",
    "missing_with_all" => ":Attribute harus hilang ketika :values ada.",
    "multiple_of" => ":Attribute harus merupakan kelipatan dari :value.",
    "not_in" => ":Attribute yang dipilih tidak valid.",
    "not_regex" => "Format :attribute tidak valid.",
    "numeric" => ":Attribute harus berupa angka.",
    "password" => [
        "letters" => ":Attribute harus mengandung setidaknya satu huruf.",
        "mixed" =>
            ":Attribute harus mengandung setidaknya satu huruf besar dan satu huruf kecil.",
        "numbers" => ":Attribute harus mengandung setidaknya satu angka.",
        "symbols" => ":Attribute harus mengandung setidaknya satu simbol.",
        "uncompromised" =>
            ":Attribute yang diberikan telah muncul dalam kebocoran data. Silakan pilih :attribute yang berbeda.",
    ],
    "present" => ":Attribute wajib ada.",
    "present_if" => ":Attribute wajib ada ketika :other bernilai :value.",
    "present_unless" => ":Attribute wajib ada kecuali :other bernilai :value.",
    "present_with" => ":Attribute wajib ada ketika :values ada.",
    "present_with_all" => ":Attribute wajib ada ketika :values ada.",
    "prohibited" => ":Attribute dilarang ada.",
    "prohibited_if" => ":Attribute dilarang ada ketika :other bernilai :value.",
    "prohibited_if_accepted" =>
        ":Attribute dilarang ada ketika :other diterima.",
    "prohibited_if_declined" =>
        ":Attribute dilarang ada ketika :other ditolak.",
    "prohibited_unless" =>
        ":Attribute dilarang ada kecuali :other ada di :values.",
    "prohibits" => ":Attribute melarang :other untuk ada.",
    "regex" => "Format :attribute tidak valid.",
    "required" => ":Attribute wajib diisi.",
    "required_array_keys" => ":Attribute wajib berisi entri untuk: :values.",
    "required_if" => ":Attribute wajib diisi bila :other bernilai :value.",
    "required_if_accepted" => ":Attribute wajib diisi bila :other diterima.",
    "required_if_declined" => ":Attribute wajib diisi bila :other ditolak.",
    "required_unless" =>
        ":Attribute wajib diisi kecuali :other memiliki nilai :values.",
    "required_with" => ":Attribute wajib diisi bila terdapat :values.",
    "required_with_all" => ":Attribute wajib diisi bila terdapat :values.",
    "required_without" => ":Attribute wajib diisi bila tidak terdapat :values.",
    "required_without_all" =>
        ":Attribute wajib diisi bila sama sekali tidak terdapat :values.",
    "same" => ":Attribute dan :other harus sama.",
    "size" => [
        "array" => ":Attribute harus mengandung :size anggota.",
        "file" => ":Attribute harus berukuran :size kilobita.",
        "numeric" => ":Attribute harus bernilai :size.",
        "string" => ":Attribute harus berukuran :size karakter.",
    ],
    "starts_with" =>
        ":Attribute harus diawali salah satu dari berikut: :values.",
    "string" => ":Attribute harus berupa string.",
    "timezone" => ":Attribute harus berupa zona waktu yang valid.",
    "unique" => ":Attribute sudah ada sebelumnya.",
    "uploaded" => ":Attribute gagal diunggah.",
    "uppercase" => ":Attribute harus berupa huruf kapital.",
    "url" => ":Attribute harus berupa URL yang valid.",
    "ulid" => ":Attribute harus berupa ULID yang valid.",
    "uuid" => ":Attribute harus berupa UUID yang valid.",

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Kustom untuk Validasi
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan
    | menggunakan konvensi "attribute.rule" untuk menamai baris. Hal ini
    | mempercepat dalam menentukan baris bahasa kustom yang spesifik.
    |
    */

    "custom" => [
        "attribute-name" => [
            "rule-name" => "custom-message",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atribut Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar placeholder atribut dengan
    | sesuatu yang lebih mudah dimengerti pembaca seperti "Alamat E-Mail"
    | sebagai ganti "email". Ini membantu pesan kita lebih ekspresif.
    |
    */

    "attributes" => [
        "email" => "Email",
        "password" => "Kata Sandi",
        "username" => "Nama Pengguna",
        "name" => "Nama",
        "first_name" => "Nama Depan",
        "last_name" => "Nama Belakang",
        "phone" => "Nomor Telepon",
        "address" => "Alamat",
        "city" => "Kota",
        "role" => "Peran",
        "content" => "Konten",
        "title" => "Judul",
        "description" => "Deskripsi",
        "date" => "Tanggal",
        "time" => "Waktu",
        "day" => "Hari",
        "month" => "Bulan",
        "year" => "Tahun",
        "size" => "Ukuran",
        "gender" => "Jenis Kelamin",
    ],
];

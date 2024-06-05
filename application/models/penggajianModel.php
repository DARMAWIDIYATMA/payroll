<?php
class PenggajianModel extends CI_model
{
    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function insert_batch($table = null, $data = array())
    {
        $jumlah = count($data);
        if ($jumlah > 0) {
            $this->db->insert_batch($table, $data);
        }
    }

    public function auto_code($table, $where)
    {
        $this->db->select_max($table);
        $auto = $this->db->get($where);
        return $auto->result_array();
    }

   
    public function cek_login()
    {
        $username = set_value('username');
        $password = set_value('password');

        $result = $this->db->where('username', $username)
                           ->limit(1)
                           ->get('data_pegawai');

        if ($result->num_rows() > 0) {
            $user = $result->row();
            if ($user->status_keaktifan !== 'Aktif') {
                return 'inactive';
            } elseif ($user->password !== md5($password)) {
                return 'wrong_password';
            } else {
                return $user;
            }
        } else {
            return 'no_user';
        }
    }


    public function potonganCutiBulanTahun($bulantahun)
    {
        $query = $this->db->query("SELECT
                a.nip,
                b.nama_pegawai,
                c.nama_cuti,
                a.jumlah_hari,
                a.tanggal_pengajuan,
                a.tgl_mulai_cuti,
                a.tgl_akhir_cuti,
                d.col_jabatan,
                e.gaji_pokok,
                e.transport,
                e.uang_makan,                                       
                DATE_FORMAT(a.tgl_mulai_cuti,'%m%Y') as kode_mulai,
                DATE_FORMAT(a.tgl_akhir_cuti,'%m%Y') as kode_akhir
                FROM data_cuti a
                JOIN data_pegawai b ON a.nip = b.nip
                JOIN cuti c ON a.id_cuti = c.id
                JOIN relation_cuti_potongan d ON d.id_cuti = c.id
                JOIN data_jabatan e ON e.id_jabatan = a.id_jabatan
                WHERE a.status_approval = 'SUCCESS'
                AND (DATE_FORMAT(a.tgl_mulai_cuti,'%m%Y') = $bulantahun OR DATE_FORMAT(a.tgl_akhir_cuti,'%m%Y') = $bulantahun);
                            ")->result();
        return $query;
    }
    public function potonganCutiById($nip)
    {
        $query = $this->db->query("SELECT
                                a.nip,
                                b.nama_pegawai,
                                c.nama_cuti,
                                a.jumlah_hari,
                                a.tanggal_pengajuan,
                                a.tgl_mulai_cuti,
                                a.tgl_akhir_cuti,
                                d.col_jabatan,
                                e.gaji_pokok,
                                e.transport,
                                e.uang_makan,                                       
                                DATE_FORMAT(a.tgl_mulai_cuti,'%m%Y') as kode_mulai,
                                DATE_FORMAT(a.tgl_akhir_cuti,'%m%Y') as kode_akhir
                            FROM data_cuti a
                            JOIN data_pegawai b ON a.nip = b.nip
                            JOIN cuti c ON a.id_cuti = c.id
                            JOIN relation_cuti_potongan d ON d.id_cuti = c.id
                            JOIN data_jabatan e ON e.id_jabatan = a.id_jabatan
                            WHERE a.status_approval = 'SUCCESS'
                            AND a.nip = $nip;
                            ")->result();
        return $query;
    }
    public function getTableId($table, $pk, $id)
    {
        $query = $this->db->query("SELECT * FROM $table WHERE $pk = $id")->result();
        return $query;
    }
    public function getDataRelation($id)
    {
        $query = $this->db->query("SELECT * FROM relation_cuti_potongan WHERE id_cuti = $id")->result();
        return $query;
    }
    public function checkData($id)
    {
        $query = $this->db->query("SELECT * FROM data_cuti WHERE id_cuti = $id")->result();
        return $query;
    }
    public function checkDataPKP($id)
    {
        $query = $this->db->query("SELECT * FROM data_pph WHERE id = $id")->result();
        return $query;
    }
    public function listActiveKaryawan()
    {
        $query = $this->db->query("SELECT * FROM data_pegawai a 
        JOIN data_jabatan b ON a.id_jabatan = b.id_jabatan 
        LEFT JOIN lokasi_kerja c ON a.id_lokasi_kerja_pk = c.id
        WHERE status_keaktifan = 'Aktif'")->result();
        return $query;
    }
    public function listActiveKaryawanId($nip)
    {
        $query = $this->db->query("SELECT * FROM data_pegawai a 
        JOIN data_jabatan b ON a.id_jabatan = b.id_jabatan 
        LEFT JOIN lokasi_kerja c ON a.id_lokasi_kerja_pk = c.id
        WHERE a.status_keaktifan = 'Aktif' AND a.nip = '$nip'")->result();
        return $query;
    }
    public function getDataKehadiran($bulan, $nip)
    {
        $query = $this->db->query("SELECT * FROM data_kehadiran WHERE bulan = '$bulan' AND nip = '$nip';")->result();
        return $query;
    }
    public function getDataPromosi()
    {
        $query = $this->db->query("SELECT 
        a.id,
        a.nip_pk,
        a.alasan_promosi,
        a.tanggal,
        a.bulan,
        a.status,
        a.keterangan,
        b.nama_pegawai,
        c.nama_jabatan as jabatan_baru,
        d.nama_jabatan as jabatan_lama
        FROM riwayat_promosi a 
        JOIN data_pegawai b ON a.nip_pk = b.nip
        JOIN data_jabatan c ON a.id_jabatan_new_pk = c.id_jabatan
        JOIN data_jabatan d ON a.id_jabatan_recent_pk = d.id_jabatan
        ")->result();
        return $query;
    }
    public function getDataPromosiDate($tgl_awal, $tgl_akhir, $nip)
    {
        if ($nip == '') {
            $tambahNip = '';
        } else {
            $tambahNip = "AND a.nip_pk = '$nip'";
        }
        $query = $this->db->query("SELECT 
        a.id,
        a.nip_pk,
        a.alasan_promosi,
        a.tanggal,
        a.bulan,
        a.status,
        a.keterangan,
        b.nama_pegawai,
        c.nama_jabatan as jabatan_baru,
        d.nama_jabatan as jabatan_lama
        FROM riwayat_promosi a 
        JOIN data_pegawai b ON a.nip_pk = b.nip
        JOIN data_jabatan c ON a.id_jabatan_new_pk = c.id_jabatan
        JOIN data_jabatan d ON a.id_jabatan_recent_pk = d.id_jabatan
        AND DATE_FORMAT(a.tanggal,'%Y-%m-%d') >= '$tgl_awal' AND DATE_FORMAT(a.tanggal,'%Y-%m-%d') <= '$tgl_akhir' $tambahNip;
        ")->result();
        return $query;
    }
    public function getDataMutasi()
    {
        $query = $this->db->query("SELECT 
        a.id,
        a.nip_pk,
        a.alasan_mutasi,
        a.tanggal,
        a.bulan,
        a.status,
        b.nama_pegawai,
        c.nama_jabatan as jabatan_baru,
        d.nama_jabatan as jabatan_lama,
        e.nama_lokasi as lokasi_baru,
        f.nama_lokasi as lokasi_lama
        FROM riwayat_mutasi a 
        JOIN data_pegawai b ON a.nip_pk = b.nip
        JOIN data_jabatan c ON a.id_jabatan_new_pk = c.id_jabatan
        JOIN data_jabatan d ON a.id_jabatan_recent_pk = d.id_jabatan
        JOIN lokasi_kerja e ON a.id_lokasi_kerja_new_pk = e.id
        JOIN lokasi_kerja f ON a.id_lokasi_kerja_recent_pk = f.id;
        ")->result();
        return $query;
    }
    public function getDataMutasiDate($tgl_awal, $tgl_akhir, $nip)
    {
        if ($nip == '') {
            $tambahNip = '';
        } else {
            $tambahNip = "AND a.nip_pk = '$nip'";
        }
        $query = $this->db->query("SELECT 
        a.id,
        a.nip_pk,
        a.alasan_mutasi,
        a.tanggal,
        a.bulan,
        a.status,
        b.nama_pegawai,
        c.nama_jabatan as jabatan_baru,
        d.nama_jabatan as jabatan_lama,
        e.nama_lokasi as lokasi_baru,
        f.nama_lokasi as lokasi_lama
        FROM riwayat_mutasi a 
        JOIN data_pegawai b ON a.nip_pk = b.nip
        JOIN data_jabatan c ON a.id_jabatan_new_pk = c.id_jabatan
        JOIN data_jabatan d ON a.id_jabatan_recent_pk = d.id_jabatan
        JOIN lokasi_kerja e ON a.id_lokasi_kerja_new_pk = e.id
        JOIN lokasi_kerja f ON a.id_lokasi_kerja_recent_pk = f.id
        AND DATE_FORMAT(a.tanggal,'%Y-%m-%d') >= '$tgl_awal' AND DATE_FORMAT(a.tanggal,'%Y-%m-%d') <= '$tgl_akhir' $tambahNip;
        ")->result();
        return $query;
    }
    public function getDataPHK()
    {
        $query = $this->db->query("SELECT 
        a.id,
        a.nip_pk,
        a.alasan_phk,
        a.tanggal,
        a.bulan,
        a.status,
        b.nama_pegawai
        FROM riwayat_phk a 
        JOIN data_pegawai b ON a.nip_pk = b.nip;
        ")->result();
        return $query;
    }
    public function getDataPHKDate($tgl_awal, $tgl_akhir, $nip)
    {
        if ($nip == '') {
            $tambahNip = '';
        } else {
            $tambahNip = "AND a.nip_pk = '$nip'";
        }
        $query = $this->db->query("SELECT 
        a.id,
        a.nip_pk,
        a.alasan_phk,
        a.tanggal,
        a.bulan,
        a.status,
        b.nama_pegawai
        FROM riwayat_phk a 
        JOIN data_pegawai b ON a.nip_pk = b.nip
        AND DATE_FORMAT(a.tanggal,'%Y-%m-%d') >= '$tgl_awal' AND DATE_FORMAT(a.tanggal,'%Y-%m-%d') <= '$tgl_akhir' $tambahNip;

        ")->result();
        return $query;
    }
    public function listMasaKaryawan($tgl_thr)
    {
        $query = $this->db->query("SELECT
        a.nip,
        a.nama_pegawai,
        b.nama_jabatan,
        a.status,
        a.status_keaktifan,
        b.gaji_pokok,
        a.tgl_masuk,
        (DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(a.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(a.tgl_masuk,'%m')) AS 'masa_kerja_bulan',
    CONCAT(
    FLOOR(((DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(a.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(a.tgl_masuk,'%m')))/12),' Tahun ',
    MOD((DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(a.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(a.tgl_masuk,'%m')),12), ' Bulan'
    ) AS 'masa_kerja',
    '$tgl_thr' as 'tgl_thr'
    FROM data_pegawai a
    JOIN data_jabatan b ON a.id_jabatan = b.id_jabatan
    WHERE a.status_keaktifan = 'Aktif'")->result();
        return $query;
    }
    public function listMasaKaryawanId($tgl_thr, $nip)
    {
        $query = $this->db->query("SELECT
        a.nip,
        a.nama_pegawai,
        b.nama_jabatan,
        a.status,
        a.status_keaktifan,
        b.gaji_pokok,
        a.tgl_masuk,
        (DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(a.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(a.tgl_masuk,'%m')) AS 'masa_kerja_bulan',
    CONCAT(
    FLOOR(((DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(a.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(a.tgl_masuk,'%m')))/12),' Tahun ',
    MOD((DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(a.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(a.tgl_masuk,'%m')),12), ' Bulan'
    ) AS 'masa_kerja',
    '$tgl_thr' as 'tgl_thr'
    FROM data_pegawai a
    JOIN data_jabatan b ON a.id_jabatan = b.id_jabatan
    WHERE a.status_keaktifan = 'Aktif'
    AND a.nip = '$nip';")->result();
        return $query;
    }
    public function listKalenderTHR()
    {
        $query = $this->db->query("SELECT a.id, a.tanggal_thr, a.bulan_thr, b.id_kalender_thr_pk FROM kalender_thr a LEFT JOIN riwayat_thr b ON a.id = b.id_kalender_thr_pk GROUP BY a.id;")->result();
        return $query;
    }
    public function semuaTHR($tgl_thr)
    {
        $query = $this->db->query("SELECT 
        c.nip,
        c.nama_pegawai,
        c.tgl_masuk,
        b.tanggal_thr as tgl_thr,
        d.gaji_pokok,
        a.nominal,
        CONCAT(
    FLOOR(((DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(c.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(c.tgl_masuk,'%m')))/12),' Tahun ',
    MOD((DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(c.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(c.tgl_masuk,'%m')),12), ' Bulan'
    ) AS 'masa_kerja'
        FROM riwayat_thr a
        JOIN kalender_thr b ON a.id_kalender_thr_pk = b.id
        JOIN data_pegawai c ON a.nip_pk = c.nip
        JOIN data_jabatan d ON c.id_jabatan = d.id_jabatan
        WHERE b.tanggal_thr = '$tgl_thr'
        AND c.status_keaktifan = 'Aktif'
        ")->result();
        return $query;
    }
    public function semuaTHRnip($tgl_thr, $nip)
    {
        $query = $this->db->query("SELECT 
        c.nip,
        c.nama_pegawai,
        c.tgl_masuk,
        b.tanggal_thr as tgl_thr,
        d.gaji_pokok,
        a.nominal,
        CONCAT(
    FLOOR(((DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(c.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(c.tgl_masuk,'%m')))/12),' Tahun ',
    MOD((DATE_FORMAT('$tgl_thr','%Y')-DATE_FORMAT(c.tgl_masuk,'%Y'))*12+(DATE_FORMAT('$tgl_thr','%m')-DATE_FORMAT(c.tgl_masuk,'%m')),12), ' Bulan'
    ) AS 'masa_kerja'
        FROM riwayat_thr a
        JOIN kalender_thr b ON a.id_kalender_thr_pk = b.id
        JOIN data_pegawai c ON a.nip_pk = c.nip
        JOIN data_jabatan d ON c.id_jabatan = d.id_jabatan
        WHERE b.tanggal_thr = '$tgl_thr'
        AND c.status_keaktifan = 'Aktif'
        AND c.nip = '$nip'
        ")->result();
        return $query;
    }
    public function checkAvailableKalenderTHR($date)
    {
        $query = $this->db->query("SELECT COUNT(*) as jumlah FROM `kalender_thr`
        WHERE DATE_FORMAT(tanggal_thr,'%Y') = DATE_FORMAT('$date','%Y')
        ")->result();
        return $query;
    }
    public function listDataHistoryJabatan($nip)
    {
        $query = $this->db->query("SELECT 
        a.tanggal,
        b.nama_jabatan
        FROM riwayat_promosi a
        JOIN data_jabatan b ON a.id_jabatan_recent_pk = b.id_jabatan
        WHERE a.nip_pk = '$nip'
        ORDER BY a.tanggal DESC;
        ")->result();
        return $query;
    }
    
}

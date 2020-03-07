<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use App\Nilai;
use App\Setting;
use App\Siswa;
use App\User;
use Auth;
use PDF;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(){
        $set = Setting::where('id',1)->first();
        $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        for($i=0;$i<count($bulan);$i++){
            if(date('n',strtotime($set->countdown)) == $i+1){
                $b = $bulan[$i];
            }
        }
        $date = date('j / ',strtotime($set->countdown)).$b.date(' / Y',strtotime($set->countdown));
        return view('index',[
            'date'=>$date,
            'set'=>$set
        ]);
    }
    public function panduan(){
        $data = Setting::where('id',1)->first();
        return view('panduan',['data'=>$data]);
    }
    public function search(Request $request,$no){
        $data = Nilai::where('no_ujian',$no)->get();
        $p    = Siswa::where('no_ujian',$no)->first();
        Siswa::where('no_ujian',$no)->update(['cek'=>1]);
        return response()->json(['success'=>[$data,$p]]);
    }
    public function print(Request $request,$no){
        $nomor = '421/18/SMK.18/VI/2014';
        $data  = Nilai::where('no_ujian',$no)->get();
        $p     = Siswa::where('no_ujian',$no)->first();
        $set   = Setting::where('id',1)->first();
        $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        for($i=0;$i<count($bulan);$i++){
            if(date('n',strtotime($p->tgl_lahir)) == $i+1){
                $b = $bulan[$i];
            }
        }
        $date  = date('j',strtotime($p->tgl_lahir)).' '.$b.' '.date('Y',strtotime($p->tgl_lahir));
        $pdf   = PDF::loadview('print',[
            'data'=>$data,'p'=>$p,'s'=>$set,'nomor'=>$nomor,'date'=>$date
            ]);
        return $pdf->stream();
    }

    // Admin
    public function siswa(Request $request){
        $data = Siswa::all();
        return view('siswa',[
            'data'=>$data
        ]);
    }
    public function siswa_import(Request $request){
        $this->validate($request,[
            'file'=>'required|mimes:csv,txt'
        ]);
        $file = $request->file('file');
        $name = date('YmdHis').'_'.$file->getClientOriginalName();
        $file->move(public_path('data-file/upload/import_siswa'),$name);
        $file = fopen(public_path('data-file/upload/import_siswa/'.$name), 'r');
        $row = [];
        while (($rows = fgetcsv($file)) !== false){
            $row[] = $rows;
        }
        fclose($file);
        array_shift($row);
        for($i=0;$i<count($row);$i++){
            if(count($row[$i]) !== 6){
                return redirect()->back()->with('i-error','Format tidak sesuai');
            }
            for($j=0;$j<count($row[$i]);$j++){
                
                $no_ujian= $row[$i][0];
                $nama    = strtoupper($row[$i][1]);
                $kelas   = strtoupper($row[$i][2]);
                $jurusan = strtoupper($row[$i][3]);
                $tgl     = date('d-m-y',strtotime($row[$i][4]));
                $ket     = strtoupper($row[$i][5]);
            }
            $cek = Siswa::where('no_ujian',$no_ujian)->first();
            if($cek){
                $b = $i+2;
                return redirect()->back()->with('i-error','no ujian sudah digunakan. baris ke '.$b);
            }
            Siswa::create([
                'no_ujian'=>$no_ujian,
                'nama_siswa'=>$nama,
                'kelas'=>$kelas,
                'jurusan'=>$jurusan,
                'tgl_lahir'=>$tgl,
                'ket'=>$ket
            ]);
        }
        return redirect()->back()->with('i-error','Siswa Berhasil Diimport')->with('success','s');
    }
    public function siswa_delete_all(){
        Siswa::truncate();
        return redirect()->back()->with('i-error','Siswa Berhasil Dihapus Semua')->with('success','s');
    }
    public function siswa_edit(Request $request){
        $this->validate($request,[
            'no_ujian'=>'required',
            'nama'=>'required|min:2',
            'kelas'=>'required',
            'jurusan'=>'required',
            'tgl_lahir'=>'required',
        ]);
        $id         = $request->id;
        $no         = $request->no_ujian;
        $nama       = strtoupper($request->nama);
        $kelas      = $request->kelas;
        $jurusan    = strtoupper($request->jurusan);
        $tgl_lahir  = $request->tgl_lahir;
        $ket        = strtoupper($request->ket);
        Siswa::where('id_siswa',$id)->update([
            'no_ujian'=>$no,
            'nama_siswa'=>$nama,
            'kelas'=>$kelas,
            'jurusan'=>$jurusan,
            'tgl_lahir'=>$tgl_lahir,
            'ket'=>$ket
        ]);
        return redirect()->back()->with('success','s')->with('i-error','Siswa Berhasil Diupdate');
    }
    public function siswa_delete(Request $request,$id){
        Siswa::where('id_siswa',$id)->delete();
        return redirect()->back()->with('success','s')->with('i-error','Siswa Berhasil Dihapus');
    }
    public function siswa_add(Request $request){
        $this->validate($request,[
            'no_ujian'=>'required',
            'nama'=>'required|min:2',
            'kelas'=>'required',
            'jurusan'=>'required',
            'tgl_lahir'=>'required',
        ]);
        $no         = $request->no_ujian;
        $nama       = strtoupper($request->nama);
        $kelas      = $request->kelas;
        $jurusan    = strtoupper($request->jurusan);
        $tgl_lahir  = $request->tgl_lahir;
        $ket        = strtoupper($request->ket);
        $cek        = Siswa::where('no_ujian',$no)->first();

        if($cek){
            return redirect()->back()->with('i-error','No Ujian Tersebut Sudah dipakai');
        }
        Siswa::create([
            'no_ujian'=>$no,
            'nama_siswa'=>$nama,
            'kelas'=>$kelas,
            'jurusan'=>$jurusan,
            'tgl_lahir'=>$tgl_lahir,
            'ket'=>$ket
        ]);
        return redirect()->back()->with('success','s')->with('i-error','Siswa Berhasil Ditambahkan');
    }

    public function nilai(Request $request){
        $data  = DB::select("SELECT * FROM nilai,siswa WHERE nilai.no_ujian = siswa.no_ujian");
        $siswa = Siswa::all();
        return view('nilai',[
            'data'=>$data,
            'siswa'=>$siswa
        ]);
    }
    public function nilai_add(Request $request){
        $no     = $request->no_ujian;
        $mapel  = strtoupper($request->mapel);
        $ns     = $request->ns;
        $nun    = $request->nun;
        $na     = $request->na;

        Nilai::create([
            'no_ujian'=>$no,
            'nama_mapel'=>$mapel,
            'nilai_sekolah'=>$ns,
            'nilai_un'=>$nun,
            'nilai_akhir'=>$na
        ]);
        return redirect()->back()->with('i-error','Nilai Berhasil Ditambahkan')->with('success','s');
    }
    public function nilai_delete(Request $request,$id){
        Nilai::where('id_nilai',$id)->delete();
        return redirect()->back()->with('i-error','Nilai Berhasil Dihapus')->with('success','s');
    }
    public function nilai_edit(Request $request){
        $id     = $request->id;
        $mapel  = strtoupper($request->mapel);
        $ns     = $request->ns;
        $nun    = $request->nun;
        $na     = $request->na;
        Nilai::where('id_nilai',$id)->update([
            'nama_mapel'=>$mapel,
            'nilai_sekolah'=>$ns,
            'nilai_un'=>$nun,
            'nilai_akhir'=>$na
        ]);

        return redirect()->back()->with('i-error','Nilai Berhasil diupdate')->with('success','s');
    }
    public function nilai_delete_all(Request $request){
        Nilai::truncate();

        return redirect()->back()->with('i-error','Nilai Berhasil dibersihkan')->with('success','s');
    }
    public function nilai_import(Request $request){
        $this->validate($request,[
            'file'=>'required|mimes:csv,txt'
        ]);
        $file = $request->file('file');
        $name = date('YmdHis').'_'.$file->getClientOriginalName();
        $file->move(public_path('data-file/upload/import_siswa'),$name);
        $file = fopen(public_path('data-file/upload/import_siswa/'.$name), 'r');
        $row = [];
        while (($rows = fgetcsv($file)) !== false){
            $row[] = $rows;
        }
        fclose($file);
        array_shift($row);
        for($i=0;$i<count($row);$i++){
            if(count($row[$i]) !== 5){
                return redirect()->back()->with('i-error','Format tidak sesuai');
            }
            for($j=0;$j<count($row[$i]);$j++){
                $no_ujian = $row[$i][0];
                $mapel    = strtoupper($row[$i][1]);
                $ns       = $row[$i][2];
                $nun      = $row[$i][3];
                $na       = $row[$i][4];
            }
            Nilai::create([
                'no_ujian'=>$no_ujian,
                'nama_mapel'=>$mapel,
                'nilai_sekolah'=>$ns,
                'nilai_un'=>$nun,
                'nilai_akhir'=>$na
            ]);
        }
        return redirect()->back()->with('i-error','Data Berhasil Diimport')->with('success','s');
    }


    public function user(Request $request){
        $data = DB::select("SELECT * FROM users where not email='kurniawan@mail.com'");
        return view('user',[
            'data'=>$data
        ]);
    }
    public function user_add(Request $request){
        $this->validate($request,[
            'email'=>'required|unique:users',
            'nama'=>'required',
            'password'=>'required'
        ]);
        $name       = $request->nama;
        $email      = $request->email;
        $password   = $request->password;
        $token      =  Str::random(4);
        User::create([
            'name'=>$name,
            'email'=>strtolower($email),
            'password'=>bcrypt($password),
            'remember_token'=>$token,
        ]);
        return redirect()->back()->with('success','s')->with('i-error','User berhasil ditambahkan');
    }
    public function user_edit(Request $request){
        $this->validate($request,[
            'nama'=>'required',
            'password'=>'required'
        ]);
        $id         = $request->id;
        $name       = $request->nama;
        $email      = $request->email;
        $password   = $request->password;
        $token      =  Str::random(4);
        $cek        = User::where('id',$id)->first();
        if($cek->email !== $email){
            User::where('id',$id)->update([
                'email'=>strtolower($email),
                'remember_token'=>$token,
            ]);
        }
        if($password == 'null1234'){
            User::where('id',$id)->update([
                'name'=>$name,
                'remember_token'=>$token,
            ]);
            return redirect()->back()->with('success','s')->with('i-error','User berhasil diupdate');
        }
        User::where('id',$id)->update([
            'name'=>$name,
            'password'=>bcrypt($password),
            'remember_token'=>$token,
        ]);
        return redirect()->back()->with('success','s')->with('i-error','User berhasil diupdate');

    }
    public function user_delete(Request $request,$id){
        User::where('id',$id)->delete();
        return redirect()->back()->with('success','s')->with('i-error','User berhasil dihapus');
    }

    public function admin(Request $request){
        return view('admin');
    }
    public function setting(Request $request){
        $data = Setting::where('id',1)->first();
        return view('setting',['data'=>$data]);
    }
    public function setting_update(Request $request){
        if(isset($request->catatan)){
            Setting::where('id',1)->update([
                'catatan'=>$request->catatan
            ]);
            return response()->json(['success'=>true]);
        }
        if(isset($request->print_html)){
            Setting::where('id',1)->update([
                'print_html'=>$request->print_html
            ]);
            return response()->json(['success'=>true]);
        }

        if(isset($request->panduan)){
            Setting::where('id',1)->update([
                'panduan'=>$request->panduan
            ]);
            return response()->json(['success'=>true]);
        }
        if(isset($request->print)){
            $no_s   = $request->no_s;
            $th_ajr = $request->th_ajr;
            $nm_kpl = $request->nm_kpl;
            $no_kpl = $request->no_kpl;

            Setting::where('id',1)->update([
                'no_s'=>$no_s,
                'th_ajr'=>$th_ajr,
                'nm_kpl'=>$nm_kpl,
                'no_kpl'=>$no_kpl,
                'perihal'=>$request->perihal,
                'nm_skl'=>$request->nm_skl,
                'lokasi'=>$request->lokasi
            ]);
            return response()->json(['success'=>true]);
        }
        if($request->pengumuman){
            $pengumuman = $request->pengumuman;
            Setting::where('id',1)->update([
                'pengumuman'=>$pengumuman,
            ]);
            return response()->json(['success'=>$request->pengumuman]);
        }
        $cd     = $request->cd;
        $kop    = $request->file('kop');
        $ttd    = $request->ttd;
        if(isset($cd)){
            Setting::where('id',1)->update([
                'countdown'=>$cd
            ]);
        }
        if(isset($kop)){
            $ext = $kop->extension();
            $kop->move(public_path('/data-file/'),'kop.'.$ext);
            Setting::where('id',1)->update([
                'kop'=>'kop.'.$ext,
            ]);
        }
        if(isset($ttd)){
            $ext = $ttd->extension();
            $ttd->move(public_path('/data-file/'),'ttd.'.$ext);
            Setting::where('id',1)->update([
                'ttd'=>'ttd.'.$ext,
            ]);
        }
        return redirect()->back()->with('i-error','Setting Berhasil Diupdate')->with('success','s');
    }
    public function setting_delete(){
        Setting::where('id',1)->update(['catatan'=>null]);
        return response()->json(['success'=>true]);
    }


    public function cek(Request $request){
        $data = Siswa::where('cek',1)->get();
        return view('cek',[
            'data'=>$data,
        ]);
    }

    public function login(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/admin');
        }
        return redirect()->back();
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}

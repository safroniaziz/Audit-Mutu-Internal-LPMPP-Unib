<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UpdateAuditorSeeder extends Seeder
{
    /**
     * Run the database migrations.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            // Hapus semua user dengan role Auditor dan user yang emailnya sama dengan data baru
            $auditorsData = [
                [
                    'name' => 'adi',
                    'username' => '999111111111111111',
                    'email' => 'adi@mail.com'
                ],
                [
                    'name' => 'apt. Reza Rahmawati, S.Farm., M. Clin., Pharm.',
                    'username' => '199201102020122009',
                    'email' => 'rahmawati@unib.ac.id'
                ],
                [
                    'name' => 'AuditorCoba',
                    'username' => '1234567',
                    'email' => 'auditorcoba@mail'
                ],
                [
                    'name' => 'auditorTiara',
                    'username' => '199308192022032013',
                    'email' => 'auditorTiara@mail.com'
                ],
                [
                    'name' => 'AuditorUjiCoba',
                    'username' => '0000001111',
                    'email' => 'auditormagang@mail.com'
                ],
                [
                    'name' => 'CHAIRIL AFANDY, SE., MM.',
                    'username' => '197903052002121005',
                    'email' => 'chairilafandyse.mm.@mail.com'
                ],
                [
                    'name' => 'DEBBY SEFTYARIZKI, S.T., M.T.',
                    'username' => '199009282018032001',
                    'email' => 'debbyseftyarizkis.t.m.t.@mail.com'
                ],
                [
                    'name' => 'DEBIE RIZQOH, S.Si., M.Biomed.',
                    'username' => '198905192019032020',
                    'email' => 'debierizqohs.si.m.biomed.@mail.com'
                ],
                [
                    'name' => 'DIAH AYU AGUSPA DITA, S.Kep., Ns., M. Biomed.',
                    'username' => '199208062019032022',
                    'email' => 'diahayuaguspaditas.kep.ns.m.biomed.@mail.com'
                ],
                [
                    'name' => 'DONI NOTRIAWAN, S.Si., M.Si.',
                    'username' => '198911022019031011',
                    'email' => 'doninotriawans.si.m.si.@mail.com'
                ],
                [
                    'name' => 'Dr. DHANURSETO HADIPRASHADA, S.IP., M.Si.',
                    'username' => '198412232010121004',
                    'email' => 'dr.dhanursetohadiprashadas.ip.m.si.@mail.com'
                ],
                [
                    'name' => 'Dr. Drs. I.WAYAN DHARMAYANA, M.Psi.',
                    'username' => '196101231985031002',
                    'email' => 'dr.drs.i.wayandharmayanam.psi.@mail.com'
                ],
                [
                    'name' => 'Dr. Euis Nursa\'adah, S.Pd., M.Pd',
                    'username' => '198403062019032008',
                    'email' => 'euisnursaadah@unib.ac.id'
                ],
                [
                    'name' => 'Dr. FENNY MARIETZA, SE., M.AK',
                    'username' => '198304012009122004',
                    'email' => 'fennymarietzase.m.ak@mail.com'
                ],
                [
                    'name' => 'Dr. Fitrianty Wardhani, ST., MT',
                    'username' => '198407122009012008',
                    'email' => 'wardhani@unib.ac.id'
                ],
                [
                    'name' => 'Dr. GITA MULYASARI, SP., M.Si.',
                    'username' => '198311302006042002',
                    'email' => 'dr.gitamulyasarisp.m.si.(1)@mail.com'
                ],
                [
                    'name' => 'Dr. GUMONO, S.Pd., M.Pd.',
                    'username' => '197103131999031002',
                    'email' => 'dr.gumonos.pd.m.pd.@mail.com'
                ],
                [
                    'name' => 'Dr. Ir. DEDDY BAKHTIAR, M.Si.',
                    'username' => '196702181993031004',
                    'email' => 'dr.ir.deddybakhtiarm.si.@mail.com'
                ],
                [
                    'name' => 'Dr. Ir. RUSTIKAWATI, MP.',
                    'username' => '196505081990012001',
                    'email' => 'dr.ir.rustikawatimp.@mail.com'
                ],
                [
                    'name' => 'Dr. IRMA BADARINA, S.Pt., MP.',
                    'username' => '197001231997022001',
                    'email' => 'dr.irmabadarinas.pt.mp.@mail.com'
                ],
                [
                    'name' => 'Dr. Neni Murniati, M.Pd',
                    'username' => '198711172019032011',
                    'email' => 'nenimurniati@unib.ac.id'
                ],
                [
                    'name' => 'Dr. NURNA AZIZA N., SE., M.Si., Ak.',
                    'username' => '197605102000032001',
                    'email' => 'dr.nurnaazizan.se.m.si.ak.@mail.com'
                ],
                [
                    'name' => 'Dr. RENDY WIKRAMA WARDANA, S.Pd., M.Pd.',
                    'username' => '198608312019031012',
                    'email' => 'dr.rendywikramawardanas.pd.m.pd.@mail.com'
                ],
                [
                    'name' => 'Dr. RINA SUTHIA HAYU, SE., MM.',
                    'username' => '198203272009122006',
                    'email' => 'dr.rinasuthiahayuse.mm.@mail.com'
                ],
                [
                    'name' => 'Dr. RINI INDRIANI, SE., M.Si. Ak.',
                    'username' => '197005311997022001',
                    'email' => 'dr.riniindrianise.m.si.ak.@mail.com'
                ],
                [
                    'name' => 'Dr. SUHARYANTO, S.Pt., M.Si.',
                    'username' => '197306022002121015',
                    'email' => 'dr.suharyantos.pt.m.si.@mail.com'
                ],
                [
                    'name' => 'Dr. SYAFRYADIN, S.Pd., M.Pd.',
                    'username' => '198806182019031006',
                    'email' => 'dr.syafryadins.pd.m.pd.@mail.com'
                ],
                [
                    'name' => 'dr. Wahyu Sudarsono, M.PH',
                    'username' => '0811736764',
                    'email' => 'dr.wahyusudarsonom.ph@mail.com'
                ],
                [
                    'name' => 'Dr. YULIAN FAUZI, S.Si., M.Si.',
                    'username' => '197207271998021001',
                    'email' => 'dr.yulianfauzis.si.m.si.@mail.com'
                ],
                [
                    'name' => 'drh.TATIK SUTEKY, M.Sc.',
                    'username' => '196309161989032003',
                    'email' => 'drh.tatiksutekym.sc.@mail.com'
                ],
                [
                    'name' => 'EDDY SURANTA, SE., M.Si.Akt.',
                    'username' => '197212071998021001',
                    'email' => 'eddysurantase.m.si.akt.@mail.com'
                ],
                [
                    'name' => 'ELLEN MAIDIA DJATMIKO, S.Si., M.Biomed.',
                    'username' => '198712052019032013',
                    'email' => 'ellenmaidiadjatmikos.si.m.biomed.@mail.com'
                ],
                [
                    'name' => 'FRANSISKA TIMORIA SAMOSIR, S.Sos., M.A.',
                    'username' => '198806012015042003',
                    'email' => 'fransiskatimoriasamosirs.sos.m.a.@mail.com'
                ],
                [
                    'name' => 'HELMIZAR, ST., MT., Ph.D.',
                    'username' => '197611032005011007',
                    'email' => 'helmizarst.mt.ph.d.@mail.com'
                ],
                [
                    'name' => 'HENDY SANTOSA, ST., MT., Ph.D.',
                    'username' => '198112102008121002',
                    'email' => 'hendysantosast.mt.ph.d.@mail.com'
                ],
                [
                    'name' => 'Ir. ARIE VATRESIA, ST., M.T.I., Ph.D.',
                    'username' => '198502042008122002',
                    'email' => 'arievatresiast.m.t.i.ph.d@mail.com'
                ],
                [
                    'name' => 'Ir. BAMBANG SUMANTRI, M.Si.',
                    'username' => '196009171987021001',
                    'email' => 'ir.bambangsumantrim.si.@mail.com'
                ],
                [
                    'name' => 'Ir. Kurnia Anggraini, ST., MT., Ph.D',
                    'username' => '198901182015042004',
                    'email' => 'kurniaanggraini@unib.ac.id'
                ],
                [
                    'name' => 'JATMIKO YOGOPRIYATNO, S.IP., M.Si.',
                    'username' => '198903172019031011',
                    'email' => 'jatmikoyogopriyatnos.ip.m.si.@mail.com'
                ],
                [
                    'name' => 'KURNIA DEWIANI, SST., M.Keb.',
                    'username' => '198801162010012001',
                    'email' => 'kurniadewianisst.m.keb.@mail.com'
                ],
                [
                    'name' => 'LISA MARTIAH NILA PUSPITA, SE., M.SI.',
                    'username' => '197411202000032001',
                    'email' => 'lisamartiahnilapuspitase.m.si.@mail.com'
                ],
                [
                    'name' => 'lpmpp',
                    'username' => '198112102008121001',
                    'email' => 'lpmpp@mail.com'
                ],
                [
                    'name' => 'M. Afif Coba',
                    'username' => '12345671',
                    'email' => 'afif_coba@mail.com'
                ],
                [
                    'name' => 'Melani Anisa Fitri, S.Tr.P., MP',
                    'username' => '199605062024062003',
                    'email' => 'melani_fitri@unib.ac.id'
                ],
                [
                    'name' => 'MUKTI DONO WILOPO, S.Pi., M.Si.',
                    'username' => '198307252006041001',
                    'email' => 'muktidonowilopos@mail.com'
                ],
                [
                    'name' => 'NILA APRILA, SE., M.Si.Ak.',
                    'username' => '197504152001122001',
                    'email' => 'nilaaprilase.m.si.ak.@mail.com'
                ],
                [
                    'name' => 'Ns. TITIN APRILATUTINI, S.Kep., M.Pd.',
                    'username' => '197604141998032002',
                    'email' => 'ns.titinaprilatutinis.kep.m.pd.@mail.com'
                ],
                [
                    'name' => 'Ns. YUSRAN HASYIMI, S.Kep., M.Kep., SP.Kep.MB.',
                    'username' => '197110191995031003',
                    'email' => 'ns.yusranhasyimis.kep.m.kep.sp.kep.mb.@mail.com'
                ],
                [
                    'name' => 'NURLIANTI MUZNI, S.I.Kom., M.I.Kom',
                    'username' => '199110232020122006',
                    'email' => 'nurliantimuznis.i.kom.m.i.kom@mail.com'
                ],
                [
                    'name' => 'OKTOVIANI, S.Farm., Apt., M.Farm.',
                    'username' => '198910112018032001',
                    'email' => 'oktovianis.farm.apt.m.farm.@mail.com'
                ],
                [
                    'name' => 'PANUT SETIONO, S.Pd., M.Pd.',
                    'username' => '198902272019031015',
                    'email' => 'panutsetionos.pd.m.pd.@mail.com'
                ],
                [
                    'name' => 'Prof. Dr. ARIF ISMUL HADI, S.Si., M.Si.',
                    'username' => '197309241999031001',
                    'email' => 'dr.arifismulhadis.si.m.si@mail.com'
                ],
                [
                    'name' => 'Prof. Dr. ARONO, S.Pd., M.Pd.',
                    'username' => '197703142005011004',
                    'email' => 'prof.dr.aronos.pd.m.pd.@mail.com'
                ],
                [
                    'name' => 'Prof. Dr. IWAN SETIAWAN, S.Si., M.Sc.',
                    'username' => '198009112010121002',
                    'email' => 'dr.iwansetiawans.si.m.sc@mail.com'
                ],
                [
                    'name' => 'Prof. Dr. KAMALUDIN, S.E., M.M.',
                    'username' => '196603041998021001',
                    'email' => 'prof.dr.kamaludins@mail.com'
                ],
                [
                    'name' => 'Prof. Dr. RIDWAN NURAZI, S.E., M.Sc.',
                    'username' => '196009151989031004',
                    'email' => 'prof.dr.ridwannurazis.e.m.sc.@mail.com'
                ],
                [
                    'name' => 'Prof. LIZAR ALFANSI, S.E., M.B.A., Ph.D.',
                    'username' => '196406011989031005',
                    'email' => 'proflizaralfansis@mail.com'
                ],
                [
                    'name' => 'Prof.Dr. Ir. DWATMADJI, M.Sc.',
                    'username' => '196203121986031004',
                    'email' => 'dr.ir.dwatmadjim.sc@mail.com'
                ],
                [
                    'name' => 'RAHMA FITRI, SH., MH.',
                    'username' => '198406112010122003',
                    'email' => 'rahmafitrish.mh.@mail.com'
                ],
                [
                    'name' => 'RAHMI YURISTIA, S.P. M.Si.',
                    'username' => '198410312019032009',
                    'email' => 'rahmiyuristias.p.m.si.@mail.com'
                ],
                [
                    'name' => 'REFPO RAHMAN, S.Pd., M.Si.',
                    'username' => '199301072019031014',
                    'email' => 'refporahmans.pd.m.si.@mail.com'
                ],
                [
                    'name' => 'RIANA VERSITA, S.FARM., Apt., M.FARM.',
                    'username' => '198512112010012009',
                    'email' => 'rianaversitas.farm.apt.m.farm.@mail.com'
                ],
                [
                    'name' => 'ROSI L. VINI SIREGAR, S.Sos., M.Kesos',
                    'username' => '199102192019032018',
                    'email' => 'rosil.vinisiregars.sos.m.kesos@mail.com'
                ],
                [
                    'name' => 'SAPRINURDIN, S.Hut., M.Sc.',
                    'username' => 'SAPRINURDIN,_S.hut.,M.sc.',
                    'email' => 'saprinurdins.hut.m.sc.@mail.com'
                ],
                [
                    'name' => 'SISKA YOSMAR, S.Si., M.Si.',
                    'username' => 'SISKA_Yosmar,S.si.,M.si.',
                    'email' => 'siskayosmars.si.m.si.@mail.com'
                ],
                [
                    'name' => 'SUCI RAHMAWATI, S.Farm., Apt, M. Farm.',
                    'username' => 'SUCI_Rahmawati,S.farm.,Apt,M.Farm.',
                    'email' => 'sucirahmawatis.farm.aptm.farm.@mail.com'
                ],
                [
                    'name' => 'SUPIYATI, S.Si., M.Si.',
                    'username' => 'SUPIYATI,_S.si.,M.si.',
                    'email' => 'supiyatis.si.m.si.@mail.com'
                ],
                [
                    'name' => 'Wiwit, S.Si., M.Si., Ph.D',
                    'username' => '198205122008122002',
                    'email' => 'wiwit@unib.ac.id'
                ],
                [
                    'name' => 'WULANDARI, S.H., M.H.',
                    'username' => '199001252019032024',
                    'email' => 'wulandaris.h.m.h.@mail.com'
                ],
                [
                    'name' => 'WURI PRAMESWARI, S.P., M.Si.',
                    'username' => '198712312019032020',
                    'email' => 'wuriprameswaris.p.m.si.@mail.com'
                ],
                [
                    'name' => 'YORRY HARDAYANI, S.IP, M.Si',
                    'username' => '198611172014042002',
                    'email' => 'yorryhardayanis.ipm.si@mail.com'
                ],
                [
                    'name' => 'YULIATI, S.Sos., M.I.Kom.',
                    'username' => '198007292006042002',
                    'email' => 'yuliatis.sos.m.i.kom.@mail.com'
                ]
            ];

            // Hapus semua user dengan role Auditor
            $auditorRole = Role::where('name', 'Auditor')->first();
            if ($auditorRole) {
                $auditorUsers = User::role('Auditor')->get();
                foreach ($auditorUsers as $user) {
                    $user->removeRole('Auditor');
                    $user->delete();
                }
            }

            // Hapus SEMUA user yang memiliki email atau username yang sama dengan data baru
            $emails = array_column($auditorsData, 'email');
            $usernames = array_column($auditorsData, 'username');
            
            // Hapus berdasarkan email
            User::whereIn('email', $emails)->forceDelete();
            // Hapus berdasarkan username
            User::whereIn('username', $usernames)->forceDelete();

            // Pastikan role Auditor ada
            if (!$auditorRole) {
                $auditorRole = Role::create(['name' => 'Auditor']);
            }

            // Buat user auditor baru
            foreach ($auditorsData as $auditorData) {
                $user = User::create([
                    'name' => $auditorData['name'],
                    'username' => $auditorData['username'],
                    'email' => $auditorData['email'],
                    'password' => Hash::make($auditorData['username']), // Password sama dengan username
                    'email_verified_at' => now(),
                ]);

                // Assign role Auditor
                $user->assignRole('Auditor');
            }

            DB::commit();

            $this->command->info('Successfully updated auditor data:');
            $this->command->info('- Deleted old auditor users');
            $this->command->info('- Created ' . count($auditorsData) . ' new auditor users');
            $this->command->info('- Default password for all users: same as username');

        } catch (\Exception $e) {
            DB::rollback();
            $this->command->error('Error updating auditor data: ' . $e->getMessage());
        }
    }
}

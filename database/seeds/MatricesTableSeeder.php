<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MatricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fire_matrices')->insert([
            ['reference' => '1', 'service_type' => 'uPVC 100mm - retrofitted fire collar', 'wall_type' => 'Tested in 64mm stud x2 16mm Firecheck / 128mm thick steel frame plasterboard wall consisting of 64mm studs wth two layers of 16mm Boral Firestop plasteboard.', 'wall_type_ref' => 'Only wall type 9.41 + 9.42 + 9.43 + 9.44 + 9.46 + 9.47 + 9.82 approved on the basis 140 blockwork wall acheives the identical FRL of the 128mm tested framed wall system.

            9.22a and 9.22d concrete wall thickness to be minimum 128mm thick.', 'fire_stop_sys' => 'Snap 110R & 2x 16mm Boral Firestop', 'test_report_ref' => 'FP4874', 'test_specimen' => 'Test Result FP4874 No1                      (pg2)
            
            Figure 5, 7 & 11', 'frl_achieved' => ' -/180/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2012-10-30'), 'comments' => 'Note, AS1530.4 clause 10.11.2 the use of this same test certificate is permitted only per the veriations stated in 10.11.2 (a-e)'],
            ['reference' => '2', 'service_type' => 'uPVC 50mm  - retrofitted fire collar', 'wall_type' => 'Tested in 64mm stud x2 16mm Firecheck / 128mm thick steel frame plasterboard wall consisting of 64mm studs wth two layers of 16mm Boral Firestop plasteboard.', 'wall_type_ref' => '94.1, 9.42, 9.43, 9.44, 9.46, 9.47,  9.82', 'fire_stop_sys' => 'Snap 63R & 2x 16mm Boral Firestop', 'test_report_ref' => 'FP4874', 'test_specimen' => 'Test Result FP4874 No4                           (pg 2)
            
            Figure 2 & 8 ', 'frl_achieved' => ' -/180/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2012-10-30'), 'comments' => 'Note, AS1530.4 clause 10.11.2 the use of this same test certificate is permitted only per the veriations stated in 10.11.2 (a-e)'],
            ['reference' => '3', 'service_type' => 'uPVC 65mm', 'wall_type' => 'Tested in 64mm stud x2 16mm Firecheck / 128mm thick steel frame plasterboard wall consisting of 64mm studs wth two layers of 16mm Boral Firestop.', 'wall_type_ref' => '94.1, 9.42, 9.43, 9.44, 9.46, 9.47,  9.82', 'fire_stop_sys' => 'Snap 84R & 2x 16mm Boral Firestop', 'test_report_ref' => 'FP4874', 'test_specimen' => 'Test Result FP4874 No10                        (pg 5)
            
            Figure 3 & 14', 'frl_achieved' => ' -/180/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2012-10-30'), 'comments' => 'Note, AS1530.4 clause 10.11.2 the use of this same test certificate is permitted only per the veriations stated in 10.11.2 (a-e)'],
            ['reference' => '4', 'service_type' => 'Type B Copper pipe 100mm and then intended variation to tested system.
            Variations to tested system report - Copper pipe 15mm to 60mm ', 'wall_type' => 'Tested in 2hr stud wall.', 'wall_type_ref' => 'Single insulated copper pipe sheathed in combustible insulation (0.6mm gauge sheet metal) protected with 6mm Promaseal Flexi wrap.
            
            Variations to tested system report - Copper pipe 15mm to 60mm ', 'fire_stop_sys' => 'Combustible insulation (0.6mm gauge sheet metal) protected with 6mm Promaseal Flexi wrap.', 'test_report_ref' => 'WFRA 41281', 'test_specimen' => 'Service G', 'frl_achieved' => ' -/120/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2006-07-14'), 'comments' => 'Pipe to be minimum 100mm apart, with solid blocks infills between pipework & a course above/below/to the side. Blockwork mortar any gaps
            
            The variations to tested pipes can only be as follows;
            i. cannot be greater diameter than tested diam.
            Ii.wall thickness not less than the tested thickness.'],
            ['reference' => '5', 'service_type' => '250mm Polyvinyl Chloride - cast in slab', 'wall_type' => 'Tested in minimum 150mm slab, 80mm step up.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'HP250C + backfill with cement
            
            a. 250mm diam PVC pipe protected by 250 C fire collar.
            B. The concrete slab comprised a 80mm thick step around the pipe.
            C. Annular gap between the pipe and the slab was filled with sand and cement to a 40mm depth controlled by a backing rod.', 'test_report_ref' => 'FSP1641', 'test_specimen' => 'Penetration 2', 'frl_achieved' => ' -/180/180', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2014-06-25'), 'comments' => ''],
            ['reference' => '6', 'service_type' => '63-100mm HDPE and uPVC cast in slab', 'wall_type' => 'Tested in 150mm thick slab.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Floorwaste and Shower (FSW - H100) Collars with PVC Pipes ', 'test_report_ref' => 'FAR3932', 'test_specimen' => '(Pg9 & 10)', 'frl_achieved' => '-/240/240', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2013-12-09'), 'comments' => ''],
            ['reference' => '7', 'service_type' => ' 16mm,20 & 25 OD PE-X pipe (horizontally through walls only)', 'wall_type' => 'Tested in 90mm and 100mm stud.
            AP1 Hilti Firestop sealant CP 611A minimum 25mm sealant depth - opening to be no more than 20mm around penetration / AP2 13mm or 16mm thick fire grade plasterboard for beading upto 100mm', 'wall_type_ref' => '94.1, 9.42, 9.43, 9.44, 9.46, 9.47,  9.82', 'fire_stop_sys' => 'AP1 Hilti Firestop sealant CP 611A ', 'test_report_ref' => 'SFC33136700', 'test_specimen' => '(pg2)', 'frl_achieved' => ' -/60/60 in 90mm Stud wall  and -/90/90 in 100mm Stud wall', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2015-02-03'), 'comments' => 'Localised additional piece of gyprock around penetration required'],
            ['reference' => '10a', 'service_type' => 'uPVC 100mm horizontally penetraing 75mm Hebel party wall', 'wall_type' => 'Tested in 75mm Hebel wall.
            Specimen A
            A 50mm uPVC pipe was protected by a promaseal FCW 50 inserted centerally within the hebel power panel wall. The collar protrudes 22mm on either side. The annular gap of 5mm and to the end of the collar is sealed with promaseal and acrylic sealant. the pipe protruded 500mm from the exposed face and 2000mm from the unexposed face. a 50mm uPVC end cap was glued with Bostik Plumb-Weld PVC Pipe cement to the exposed end of the pipe. The unexposed end of the pipe was left open to the atmosphere. The service was supported twice on the unexposed side at 300mm and 1500mm. ', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => 'PROMASEAL FCW 50 protecting a 50mm uPVC pipe with PROMASEAL® AN Acrylic
            sealant on the unexposed side', 'test_report_ref' => 'A-13-816', 'test_specimen' => '50mm pipe Speciman A', 'frl_achieved' => ' -/180/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2013-05-10'), 'comments' => 'Any variation to specimen A pipe OD is not accepted.'],
            ['reference' => '10b', 'service_type' => 'uPVC 50mm horizontally penetraing 75mm Hebel party wall', 'wall_type' => 'Tested in 75mm Hebel wall.
            Specimen F
            A 100mm uPVC pipe was protected by a promaseal FCW 100 inserted centerally within the hebel power panel wall. The collar protrudes 22mm on either side. The annular gap of 5mm and to the end of the collar is sealed with promaseal and acrylic sealant. the pipe protruded 500mm from the exposed face and 2000mm from the unexposed face. a 100mm uPVC end cap was glued with Bostik Plumb-Weld PVC Pipe cement to the exposed end of the pipe. The unexposed end of the pipe was left open to the atmosphere. The service was supported twice on the unexposed side at 300mm and 1500mm. ', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => 'PROMASEAL FCW 100 protecting a 100mm uPVC pipe with PROMASEAL® AN Acrylic
            sealant on the unexposed side', 'test_report_ref' => 'A-13-816', 'test_specimen' => '100mm pipe Specimen F', 'frl_achieved' => ' -/180/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2013-05-10'), 'comments' => 'Any variation to specimen A pipe OD is not accepted.'],
            ['reference' => '11a', 'service_type' => '50mm PEX-AL-PEX penetraign concrete slab
            Must be identical to tested system report no variation to pex apipe', 'wall_type' => 'Tested in 150mm thick slab.
            The collar was cast into the concrete slab with its base flush to the underside.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Snap H50 - Gas Fire Collar protecting 50mm GASPEX PX-AL-PEX Gas Pipe. ', 'test_report_ref' => 'FSP1340', 'test_specimen' => '50mm PX-AL-PX - Penetration 7', 'frl_achieved' => '- / 240 / 180', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2009-02-27'), 'comments' => ''],
            ['reference' => '11b', 'service_type' => '32mm-63mm PEX-AL-PEX penetraign concrete slab', 'wall_type' => 'Tested in 150mm thick slab.
            Retrofit Snap63gas fire collar protecting 63mm GASPEX PX-AL-PEX gas pipe. The collar was fitted to the underside of the concrete slab with 6mm diam mechanical anchors fitted through 8mm diameter holes in 4 brackets screw fixed. 
            Only once the pipe was fitted through the hole and restrained, the resulting gap around the pipe was backfilled flush with both sides of the concrete slab using a quick drying cement.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Snap 63 - Retrofit Gas Fire Collar protecting 63mm GASPEX PX-AL-PEX Gas pipe', 'test_report_ref' => 'FSP1340', 'test_specimen' => '63mm PX-AL-PX - Penetration 5', 'frl_achieved' => '=D11+D12- / 240 / 240', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2009-02-27'), 'comments' => ''],
            ['reference' => '12', 'service_type' => '20mm PEX-AL-PEX penetrating wall
            20mm PE-X/AL/PE Pipe', 'wall_type' => 'Tested in 64mm thick stud x 2 16mm Firecheck / 128mm thick steel frame plasterboard wall consisting of 64mm studs wth two layers of 16mm Boral Firestop.', 'wall_type_ref' => '9.22a, 9.22d, 94.1, 9.42, 9.43, 9.44, 9.46, 9.47, 9.82 approved on the basis 140 blockwork wall acheives the identical FRL of the 128mm tested framed wall system.
            
            9.22a and 9.22d concrete wall thickness to be minimum 128mm thick', 'fire_stop_sys' => 'Promastop Unicollar CFC 32
            Promaseal AN Acrylic Sealant ', 'test_report_ref' => '2257300', 'test_specimen' => '20mm PX-AL-PX - Service C
            ', 'frl_achieved' => '- / 180 / 60
            ', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2008-12-18'), 'comments' => ''],
            ['reference' => '13', 'service_type' => '20mm PEX-AL-PEX penetraign wall', 'wall_type' => 'Tested in 75mm thick Hebel.', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => 'Snap GA32 Fire Collar - 20mm PX-AL-PX pipe', 'test_report_ref' => 'FSP1822', 'test_specimen' => '20mm PX-AL-PX - Penetration 7 (pg35)
            ', 'frl_achieved' => '- / 120 / 120
            ', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2017-06-15'), 'comments' => ''],
            ['reference' => '14', 'service_type' => 'HDPE 110mm horizontally penetraing 75mm Hebel party wall', 'wall_type' => 'Tested in 75mm Hebel wall.', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => 'Snap LP100R-D Retrofit Collar both sides', 'test_report_ref' => ' FSP1783', 'test_specimen' => '110mm pipe Penetration 7               (pg36)', 'frl_achieved' => ' -/90/90', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2017-02-23'), 'comments' => ''],
            ['reference' => '15', 'service_type' => 'HDPE 75mm horizontally penetraing 75mm Hebel party wall', 'wall_type' => 'Tested in 75mm Hebel wall.', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => 'Snap LP100R-D Retrofit Collar both sides', 'test_report_ref' => ' FSP1807', 'test_specimen' => '75mm pipe Penetration 1               (pg29)', 'frl_achieved' => ' -/90/90', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2017-03-23'), 'comments' => ''],
            ['reference' => '16', 'service_type' => 'uPVC 100mm floor waste penetrating ', 'wall_type' => 'Tested in 150mm thick slab.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Snap H100FWS-RR', 'test_report_ref' => 'FSP1577 & FAR3932', 'test_specimen' => '100mm pipe Penetration 4', 'frl_achieved' => '-/240/240', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2013-03-29'), 'comments' => ''],
            ['reference' => '17', 'service_type' => 'HDPE 110mm floor waste penetrating ', 'wall_type' => 'Tested in 150mm thick slab.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Snap L100FWS', 'test_report_ref' => 'FSP1592', 'test_specimen' => '110mm pipe Penetration 4            (pg28)', 'frl_achieved' => '-/240/240', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2013-07-18'), 'comments' => ''],
            ['reference' => '18', 'service_type' => 'uPVC 65mm', 'wall_type' => 'Tested in 75mm Hebel wall.', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => 'Snap LP65R  Retrofit Collar
            (Incorporating 300mm x 65mm x 4mm thick intumesh intumescent material)
            76mm diam cut out penetration through hebel wall. ', 'test_report_ref' => 'FSP 1783', 'test_specimen' => '65mm pipe Penetration 5               (pg34)', 'frl_achieved' => '/90/90', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '19', 'service_type' => 'uPVC 50mm', 'wall_type' => 'Tested in 75mm Hebel wall.', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => 'Snap LP65R  Retrofit Collar
            (Incorporating 300mm x 65mm x 4mm thick intumesh intumescent material)
            64mm diam cut out penetration through hebel wall. ', 'test_report_ref' => 'FSP 1783', 'test_specimen' => '50mm pipe Penetration 9               (pg38)', 'frl_achieved' => '/90/90', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '20', 'service_type' => 'Pex-Al-Pex 20,25,32mm', 'wall_type' => 'Tested in 75mm Hebel wall', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => '32mm Pex-Al-Pex
            
            Snap GAS32  Retrofit Collar Each Side 
            35mm Diam cut out penetration through hebel wall.
            
            25mm Pex-Al-Pex
            
            Snap GAS32  Retrofit Collar Each Side
            29mm Diam cut out penetration through hebel wall.
            
            
            20mm Pex-Al-Pex
            
            Snap GAS32  Retrofit Collar Each Side
            25mm Diam cut out penetration through hebel wall.', 'test_report_ref' => 'FSP 1822', 'test_specimen' => 'Pex-Al-pex pipe Penetrations', 'frl_achieved' => '/120/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '20a', 'service_type' => 'Pex-Al-Pex 16mm', 'wall_type' => 'Tested in 75mm Hebel wall', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => '16mm Pex-Al-Pex
            
            Snap GAS32  Retrofit Collar Each Side
            20mm Diam cut out penetration through hebel wall.', 'test_report_ref' => 'FSP 1783', 'test_specimen' => 'Pex-Al-pex pipe Penetration', 'frl_achieved' => '/120/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '21', 'service_type' => '110mm OD PVC- SC', 'wall_type' => 'Tested in 75mm Hebel wall.', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => 'Snap LP100R-D  Retrofit Collar
            114mm Diam cut out penetration through hebel wall', 'test_report_ref' => 'FSP1783', 'test_specimen' => '110mm OD PVC-SC', 'frl_achieved' => '/120/90', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '22', 'service_type' => 'Pex B pipe 20, 32mm', 'wall_type' => 'Tested in 75mm Hebel wall.', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => '32mm PexB
            
            Snap 32R  Retrofit Collar Each Side
            35mm Diam cut out penetration through hebel wall
            
            20mm PexB
            
            Snap 32R  Retrofit Collar Each Side
            25mm Diam cut out penetration through hebel wall', 'test_report_ref' => 'FSP1807', 'test_specimen' => 'PEX B Pipe Penetration 7                 (pg36)', 'frl_achieved' => '/120/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '22a', 'service_type' => 'Pex B pipe 16mm', 'wall_type' => 'Tested in 75mm Hebel wall.', 'wall_type_ref' => '6.10, 9.63, 9.64, 9.65, 9.67, 9.68, 9.69, 9.71,  ', 'fire_stop_sys' => '16mm Pex B
            
            Snap 32R  Retrofit Collar Each Side
            20mm Diam cut out penetration through hebel wall', 'test_report_ref' => 'FSP1783', 'test_specimen' => 'PEX B Pipe Penetration 2                 (pp6)', 'frl_achieved' => '/120/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '23', 'service_type' => '250mm OD PVC SC Stack Pipe - 7mm thick wall ', 'wall_type' => '150mm Concrete Slab.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Snap 250c Collar
            80mm thick step around the pipe. On unexposed face, the unnular gap between pipe and the slab was filled with sandf and cement to a 40mm depth controlled by backing rod. ', 'test_report_ref' => 'FSP1641', 'test_specimen' => 'uPVC 250m Penetration 2                      (pg 24)', 'frl_achieved' => '/180/180', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '24', 'service_type' => '110mm OD Polyvinyl Chloride Sandwich Construction (PVC-SC) Stack Pipe 3.4mm thick.', 'wall_type' => '150mm thick CSR Hebel Block Wall', 'wall_type_ref' => '9.21a, 9.21b
            Concrete wall to be a minimum 150mm thick', 'fire_stop_sys' => 'Snap HP100R Retrofit Collar
            115mm diam cut out penetration through blockwork wall.
            On  the exposed face, the annular gap between the pipe and the wall was sealed with 15mm deep bead of Fuller Firesound fire sealant. ', 'test_report_ref' => 'FSP1659', 'test_specimen' => '110mm OD Polyvinyl Chloride Sandwich Construction (PVC-SC) Stack Pipe 3.4mm thick.', 'frl_achieved' => '/240/240', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '25', 'service_type' => 'HDPE 110mm', 'wall_type' => '150mm thick CSR Hebel Block Wall', 'wall_type_ref' => '9.21a, 9.21b
            Concrete wall to be a minimum 150mm thick', 'fire_stop_sys' => 'Snap HP100R Retrofit Collar
            115mm diam cut out penetration through blockwork wall.
            On  the exposed face, the annular gap between the pipe and the wall was sealed with 15mm deep bead of Fuller Firesound fire sealant. ', 'test_report_ref' => 'FSP1659', 'test_specimen' => 'HDPE 110mm Penetration E                  (pg 27)', 'frl_achieved' => '/240/240', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '26', 'service_type' => ' 16mm,20, 25 & 32 OD PE-X AL PE-X pipe', 'wall_type' => '150mm Concrete Slab.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Snap GAS32 Retrofit Collar', 'test_report_ref' => 'FCO2719', 'test_specimen' => 'Pex-Al-Pex 32mm          
            Penetration 2  (pg7)', 'frl_achieved' => '/240/240', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '26a', 'service_type' => ' 16mm,20, 25 & 32 OD PE-X AL PE-X pipe', 'wall_type' => '150mm Concrete Slab.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Snap GAS32 Retrofit Collar', 'test_report_ref' => 'FCO2719', 'test_specimen' => 'Pex-Al-Pex 16mm          
            Penetration 1  (pg7)', 'frl_achieved' => '/240/240', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-05-07'), 'comments' => ''],
            ['reference' => '27', 'service_type' => '32mm-150mm Copper', 'wall_type' => '150mm Concrete Slab.', 'wall_type_ref' => 'Not transferable to walls.
            
            Only applicable to concrete floor penetrations.', 'fire_stop_sys' => 'Promat Promaseal & 38mm Non fibre glass based stone wool for 600mm each side fixed to pipe with 4 steel pipe clamps', 'test_report_ref' => 'RIR 25948-07', 'test_specimen' => '23, 25, 26, 27 & 29 (pg50)', 'frl_achieved' => '/120/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2017-08-10'), 'comments' => ''],
            ['reference' => '27a', 'service_type' => '32mm-150mm Copper', 'wall_type' => 'Plasterboard, Masony, ACC & Concrete Walls.', 'wall_type_ref' => '', 'fire_stop_sys' => 'Promat Promaseal & 38mm Non fibre glass based stone wool for 600mm each side fixed to pipe with 4 steel pipe clamps', 'test_report_ref' => 'RIR 25948-07', 'test_specimen' => '23, 24, 26, 27 & 28 (pg49)', 'frl_achieved' => '/120/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2017-08-10'), 'comments' => ''],
            ['reference' => '28', 'service_type' => 'uPVC / HDPE Pipe', 'wall_type' => '128mm 2 Hour Fire Rated Walls.', 'wall_type_ref' => '', 'fire_stop_sys' => 'Promat Promaseal & FCW Collar & 6mm galv steel strips 3 per collar', 'test_report_ref' => 'Angled FCW Signed RPF', 'test_specimen' => '(pg1)', 'frl_achieved' => '/120/120', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2017-08-10'), 'comments' => ''],
            ['reference' => '29', 'service_type' => '40-160mm HDPE Pipe', 'wall_type' => '75mm Hebel Panel Walls.', 'wall_type_ref' => '', 'fire_stop_sys' => 'Snap HP150R, LP100R-D, LP65R  Retrofit Collar Each Side
             penetration through hebel wall & fixed with 14-10 x 65mm hex head screws', 'test_report_ref' => 'FC10129, FSP1822, FSP1783, FSP1807', 'test_specimen' => '(pg7)', 'frl_achieved' => '/120/120 & /120/90', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2018-10-24'), 'comments' => ''],
            ['reference' => '30', 'service_type' => '16mm-25mm Pex & Pex-Al-Pex', 'wall_type' => '75mm Hebel Panel Walls.', 'wall_type_ref' => 'Backing rod and the service is positioned at the centre of the core hole & Hilti 611A 60mm sealant depth 
            
            or
            
            Service is positioned at the centre of the core hole & Hilti 611A 70mm sealant depth ', 'fire_stop_sys' => 'Hilti 611A 60mm/70mm sealant depth', 'test_report_ref' => 'FAS180439 RIR1.1', 'test_specimen' => '(pg15-16)', 'frl_achieved' => '/120/120 & /120/90', 'test_dt' => Carbon::createFromFormat('Y-m-d', '2019-03-25'), 'comments' => '']
            
        ]);
    }
}

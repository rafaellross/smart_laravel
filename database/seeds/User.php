<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' =>'rafaellross', 'username' => 'rafaellross', 'password' => '$2y$10$gyzzzNdUQuhevysdiHJizukJQuk8BZSv6iuegDPL/8qLeBOYtAaJG', 'administrator' =>1],
            ['name' =>'chris', 'username' => 'chris', 'password' => '$2y$10$gFK0ndU6ksSqCshM63f8Vu7de4c46a2Ce77yfF7tRbw0CsGb2HqhW', 'administrator' =>1],
            ['name' =>'chris.borg', 'username' => 'chris.borg', 'password' => '$2y$10$RXOQSfABAhOC6he/1xx/j.pwmqgb1u5zSNgJ/Q7K4CWLspn0U3Kx2', 'administrator' =>0],
            ['name' =>'robert.ailao', 'username' => 'robert.ailao', 'password' => '$2y$10$DsK8AKcRWZdouHvr3hNX4OfIZz5JAt1brPXgp0uyZjTIZCuv/48Ty', 'administrator' =>0],
            ['name' =>'Ilias.alevras', 'username' => 'Ilias.alevras', 'password' => '$2y$10$iYpBX0Q9CF8uxuhMFD01UeObnx92yOwQdW28u3PtL08qpDwCktuES', 'administrator' =>0],
            ['name' =>'michael.baker', 'username' => 'michael.baker', 'password' => '$2y$10$Yds9XHGdtT/jVmxUVFM7YO8dMc0.FZPAmUAmD18IkCYZ1iHiufmhW', 'administrator' =>0],
            ['name' =>'justin.broadribb', 'username' => 'justin.broadribb', 'password' => '$2y$10$WkXB4ylUewncpmkeQCDJauqT3NANB7jLoFtig8bhsYZsCWpyKdGtC', 'administrator' =>0],
            ['name' =>'eden.cole', 'username' => 'eden.cole', 'password' => '$2y$10$kvGzZBVZfPTteuxjvZBri.Gech/Wn0zoRjBLKFPucn7hFP.j78Xo2', 'administrator' =>0],
            ['name' =>'robert.cudd', 'username' => 'robert.cudd', 'password' => '$2y$10$U4Aud2glNuY.EbAD0UDOXesaXTx/i6uj5YJKggYh5.auIWBey.NOa', 'administrator' =>0],
            ['name' =>'dragan.cupac', 'username' => 'dragan.cupac', 'password' => '$2y$10$x4rLs8txROxUKsy/KSuz4ekrsLus59ezXBBC9TfEaWEb1inVYP1QK', 'administrator' =>0],
            ['name' =>'daniel.curran', 'username' => 'daniel.curran', 'password' => '$2y$10$QrErnbCSqUal2uME8Tmd1.ofd/k2ZMxh6D7h/3Ff4Lav1Q4GyfyE6', 'administrator' =>0],
            ['name' =>'ian.davison', 'username' => 'ian.davison', 'password' => '$2y$10$ec2KgryT0sZytWsqCOc.a.nbvM8aNAbVsEhgPH5t5ObCEpxaYyZ0.', 'administrator' =>0],
            ['name' =>'khalid.el-hussein', 'username' => 'khalid.el-hussein', 'password' => '$2y$10$YqyXlyG.56turTFmM35lpOJNzs5w0kNsC5ALhanqQTDOyZQYcAmNK', 'administrator' =>0],
            ['name' =>'felipe.bezerra', 'username' => 'felipe.bezerra', 'password' => '$2y$10$L5cZWWH3pG1gjtkq6jnP9.Iv4FTHVngcTDnMx.CUN1NAVBzw3pSAO', 'administrator' =>0],
            ['name' =>'nick.fletcher', 'username' => 'nick.fletcher', 'password' => '$2y$10$R8Baxo5ZDCJA7rT5HZBmFeaGvRTmhADsc8LJZXOKKL1efDIa7qOzi', 'administrator' =>0],
            ['name' =>'alex.frisken', 'username' => 'alex.frisken', 'password' => '$2y$10$WWAafGyKuPihNA422F8o.e95d2.RPw5mP.VEPt63SP1QATMDCHOte', 'administrator' =>0],
            ['name' =>'daniel.gleeson', 'username' => 'daniel.gleeson', 'password' => '$2y$10$2dN/5OK39xhhUrD8NRxnl.iRNkkm57vl2NowLjZic36/fybLKFLQ2', 'administrator' =>0],
            ['name' =>'adam.johnson', 'username' => 'adam.johnson', 'password' => '$2y$10$Dov/H1GTVFtZHOCXRZ.i6eI5lOmaeX8rE3r6epLD4NFyIcawcaeMW', 'administrator' =>0],
            ['name' =>'andrew.karavelatzis', 'username' => 'andrew.karavelatzis', 'password' => '$2y$10$f2NRQfTPur4osbDcAC4OKOfB4P/60KF1RPZalGebNP/hTDZFBVXZG', 'administrator' =>0],
            ['name' =>'daniel.karavelatzis', 'username' => 'daniel.karavelatzis', 'password' => '$2y$10$OR6oKNgVTIfinJ2KSsKK4O6MwKOPSSHKcNquwazhnhI9/EZ.PyxfO', 'administrator' =>0],
            ['name' =>'miriana.krimizis', 'username' => 'miriana.krimizis', 'password' => '$2y$10$f6OlgAmiRrVQfQL7DidCgusyHCwJWkMJIditdv30QkicFNqOAsv1a', 'administrator' =>0],
            ['name' =>'marie.molluso', 'username' => 'marie.molluso', 'password' => '$2y$10$sHtJ9JdMSn46BLyTj6BW3eNHQQZvKcpnyNiYsMQIowIvVT3fQIsLK', 'administrator' =>1],
            ['name' =>'michael.orance', 'username' => 'michael.orance', 'password' => '$2y$10$o2qbz3f/JQ75Er2JuNWcHOujivXDJYK6xQFvtYt0apOy.KkmJtrLq', 'administrator' =>0],
            ['name' =>'wayne.riches', 'username' => 'wayne.riches', 'password' => '$2y$10$AX9mmr9sm/ascsWqAziLb.sw9vmY9Rg2NJIyvG0g0Gtv3vcPqhuXm', 'administrator' =>0],
            ['name' =>'matthew.roderick', 'username' => 'matthew.roderick', 'password' => '$2y$10$Md3Wx5pBCIobzW4ejPnOiu//XJdlnY6KcHtrdh/6K1guFBIPp/d/O', 'administrator' =>0],
            ['name' =>'edward.scott', 'username' => 'edward.scott', 'password' => '$2y$10$UApp4v07XbRvt86lS29bnue3TD27qrzCWrX.Lu8QWFwxd4LCHG3zO', 'administrator' =>0],
            ['name' =>'gustavo.gavioli', 'username' => 'gustavo.gavioli', 'password' => '$2y$10$R9nLIB9ZwXGG40P5Ye4NCumO94Su2SsYgKBrmfW9xdsb/kaQLooQy', 'administrator' =>0],
            ['name' =>'bill.tsaliagos', 'username' => 'bill.tsaliagos', 'password' => '$2y$10$QMNrKg7.rMZfNKvC2Dy4oupEiORwfHPG.ehQ0TiINa8UbPDpDFx36', 'administrator' =>0],
            ['name' =>'harry.tsohalis', 'username' => 'harry.tsohalis', 'password' => '$2y$10$ReawwSPJBkMn8/JPy8mOv./Mcl6h8le/1wW7GRiRQq6g6Il0xPN4a', 'administrator' =>0],
            ['name' =>'adrian.valleta', 'username' => 'adrian.valleta', 'password' => '$2y$10$FQcXdUcAohduSTHmuQwe7.9vwqKX8JBpxSNXhGfGKGtcpBkRa7QJ2', 'administrator' =>0],
            ['name' =>'ross.boogaard', 'username' => 'ross.boogaard', 'password' => '$2y$10$GQFvFfNY4Xh9Aog3Fly9TOLhWny6ctH1IDveBA.LamYzuxi2dmFla', 'administrator' =>0],
            ['name' =>'chris.christoforakis', 'username' => 'chris.christoforakis', 'password' => '$2y$10$i2cUyGrbQjOeutsaX6nMUOqLE7HNMBzEt.QBKEhVhRoQwBvqzkN4.', 'administrator' =>0],
            ['name' =>'billy', 'username' => 'billy', 'password' => '$2y$10$tOKAs.t9zRS/3MohH0qq0eobVGSFcSMFVQf.nJ78xdOHiu7Yj/iBW', 'administrator' =>0],
            ['name' =>'tony', 'username' => 'tony', 'password' => '$2y$10$m39Akq3iARRka2uuQdYUduVIn1MLvlM4gkrqPhGyKtk.ll7FaIoZC', 'administrator' =>1],
            ['name' =>'anthony', 'username' => 'anthony', 'password' => '$2y$10$7umLbb0Vqe9XHOCPNxTY5ePCMNtuPSPHDLx0WKBTieTgr/AlPkO8a', 'administrator' =>1]
        ]);
    }
}

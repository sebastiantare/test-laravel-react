<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\Provincia;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BulkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reference: https://gist.github.com/AndresReyesDev/0c99bedb5006af3eaa7734774f3e1f5a

        // Regiones
        $regiones = [
            [1, 'Arica y Parinacota', 'AP'],
            [2, 'Tarapacá', 'TA'],
            [3, 'Antofagasta', 'AN'],
            [4, 'Atacama', 'AT'],
            [5, 'Coquimbo', 'CO'],
            [6, 'Valparaiso', 'VA'],
            [7, 'Metropolitana de Santiago', 'RM'],
            [8, 'Libertador General Bernardo O\'Higgins', 'OH'],
            [9, 'Maule', 'MA'],
            [10, 'Ñuble', 'NB'],
            [11, 'Biobío', 'BI'],
            [12, 'La Araucanía', 'AR'],
            [13, 'Los Ríos', 'LR'],
            [14, 'Los Lagos', 'LL'],
            [15, 'Aisén del General Carlos Ibáñez del Campo', 'AI'],
            [16, 'Magallanes y de la Antártica Chilena', 'MG']
        ];

        $regionesData = array_map(function ($region) {
            return [
                'id' => $region[0],
                'nombre' => $region[1],
            ];
        }, $regiones);

        Region::insert($regionesData);

        // Provincias
        $provincias = [
            [1, 'Arica', 1],
            [2, 'Parinacota', 1],
            [3, 'Iquique', 2],
            [4, 'Tamarugal', 2],
            [5, 'Antofagasta', 3],
            [6, 'El Loa', 3],
            [7, 'Tocopilla', 3],
            [8, 'Copiapó', 4],
            [9, 'Chañaral', 4],
            [10, 'Huasco', 4],
            [11, 'Elqui', 5],
            [12, 'Choapa', 5],
            [13, 'Limarí', 5],
            [14, 'Valparaíso', 6],
            [15, 'Isla De Pascua', 6],
            [16, 'Los Andes', 6],
            [17, 'Petorca', 6],
            [18, 'Quillota', 6],
            [19, 'San Antonio', 6],
            [20, 'San Felipe', 6],
            [21, 'Marga Marga', 6],
            [22, 'Santiago', 7],
            [23, 'Cordillera', 7],
            [24, 'Chacabuco', 7],
            [25, 'Maipo', 7],
            [26, 'Melipilla', 7],
            [27, 'Talagante', 7],
            [28, 'Cachapoal', 8],
            [29, 'Cardenal Caro', 8],
            [30, 'Colchagua', 8],
            [31, 'Talca', 9],
            [32, 'Cauquenes', 9],
            [33, 'Curicó', 9],
            [34, 'Linares', 9],
            [35, 'Diguillín', 10],
            [36, 'Itata', 10],
            [37, 'Punilla', 10],
            [38, 'Concepción', 11],
            [39, 'Arauco', 11],
            [40, 'Bío-Bío', 11],
            [41, 'Cautín', 12],
            [42, 'Malleco', 12],
            [43, 'Valdivia', 13],
            [44, 'Ranco', 13],
            [45, 'Llanquihue', 14],
            [46, 'Chiloé', 14],
            [47, 'Osorno', 14],
            [48, 'Palena', 14],
            [49, 'Coihayque', 15],
            [50, 'Aisén', 15],
            [51, 'Capitán Prat', 15],
            [52, 'General Carrera', 15],
            [53, 'Magallanes', 16],
            [54, 'Antártica Chilena', 16],
            [55, 'Tierra del Fuego', 16],
            [56, 'Última Esperanza', 16],
        ];

        $provincias = array_map(function ($provincia) {
            return [
                'id' => $provincia[0],
                'nombre' => $provincia[1],
                'region_id' => $provincia[2],
            ];
        }, $provincias);

        Provincia::insert($provincias);

        // Ciudades
        $ciudades = [
            [1, 'Arica', 1],
            [2, 'Camarones', 1],
            [3, 'Putre', 2],
            [4, 'General Lagos', 2],
            [5, 'Iquique', 3],
            [6, 'Alto Hospicio', 3],
            [7, 'Pozo Almonte', 4],
            [8, 'Camiña', 4],
            [9, 'Colchane', 4],
            [10, 'Huara', 4],
            [11, 'Pica', 4],
            [12, 'Antofagasta', 5],
            [13, 'Mejillones', 5],
            [14, 'Sierra Gorda', 5],
            [15, 'Taltal', 5],
            [16, 'Calama', 6],
            [17, 'Ollague', 6],
            [18, 'San Pedro De Atacama', 6],
            [19, 'Tocopilla', 7],
            [20, 'María Elena', 7],
            [21, 'Copiapó', 8],
            [22, 'Caldera', 8],
            [23, 'Tierra Amarilla', 8],
            [24, 'Chañaral', 9],
            [25, 'Diego De Almagro', 9],
            [26, 'Vallenar', 10],
            [27, 'Alto Del Carmen', 10],
            [28, 'Freirina', 10],
            [29, 'Huasco', 10],
            [30, 'La Serena', 11],
            [31, 'Coquimbo', 11],
            [32, 'Andacollo', 11],
            [33, 'La Higuera', 11],
            [34, 'Paiguano', 11],
            [35, 'Vicuña', 11],
            [36, 'Illapel', 12],
            [37, 'Canela', 12],
            [38, 'Los Vilos', 12],
            [39, 'Salamanca', 12],
            [40, 'Ovalle', 13],
            [41, 'Combarbalá', 13],
            [42, 'Monte Patria', 13],
            [43, 'Punitaqui', 13],
            [44, 'Río Hurtado', 13],
            [45, 'Valparaíso', 14],
            [46, 'Casablanca', 14],
            [47, 'Concón', 14],
            [48, 'Juan Fernández', 14],
            [49, 'Puchuncaví', 14],
            [50, 'Quintero', 14],
            [51, 'Viña Del Mar', 14],
            [52, 'Isla De Pascua', 15],
            [53, 'Los Andes', 16],
            [54, 'Calle Larga', 16],
            [55, 'Rinconada', 16],
            [56, 'San Esteban', 16],
            [57, 'La Ligua', 17],
            [58, 'Cabildo', 17],
            [59, 'Papudo', 17],
            [60, 'Petorca', 17],
            [61, 'Zapallar', 17],
            [62, 'Quillota', 18],
            [63, 'Calera', 18],
            [64, 'Hijuelas', 18],
            [65, 'La Cruz', 18],
            [66, 'Nogales', 18],
            [67, 'San Antonio', 19],
            [68, 'Algarrobo', 19],
            [69, 'Cartagena', 19],
            [70, 'El Quisco', 19],
            [71, 'El Tabo', 19],
            [72, 'Santo Domingo', 19],
            [73, 'San Felipe', 20],
            [74, 'Catemu', 20],
            [75, 'Llaillay', 20],
            [76, 'Panquehue', 20],
            [77, 'Putaendo', 20],
            [78, 'Santa María', 20],
            [79, 'Quilpué', 21],
            [80, 'Limache', 21],
            [81, 'Olmué', 21],
            [82, 'Villa Alemana', 21],
            [83, 'Santiago', 22],
            [84, 'Cerrillos', 22],
            [85, 'Cerro Navia', 22],
            [86, 'Conchalí', 22],
            [87, 'El Bosque', 22],
            [88, 'Estación Central', 22],
            [89, 'Huechuraba', 22],
            [90, 'Independencia', 22],
            [91, 'La Cisterna', 22],
            [92, 'La Florida', 22],
            [93, 'La Granja', 22],
            [94, 'La Pintana', 22],
            [95, 'La Reina', 22],
            [96, 'Las Condes', 22],
            [97, 'Lo Barnechea', 22],
            [98, 'Lo Espejo', 22],
            [99, 'Lo Prado', 22],
            [100, 'Macul', 22],
            [101, 'Maipú', 22],
            [102, 'Ñuñoa', 22],
            [103, 'Pedro Aguirre Cerda', 22],
            [104, 'Peñalolén', 22],
            [105, 'Providencia', 22],
            [106, 'Pudahuel', 22],
            [107, 'Quilicura', 22],
            [108, 'Quinta Normal', 22],
            [109, 'Recoleta', 22],
            [110, 'Renca', 22],
            [111, 'San Joaquín', 22],
            [112, 'San Miguel', 22],
            [113, 'San Ramón', 22],
            [114, 'Vitacura', 22],
            [115, 'Puente Alto', 23],
            [116, 'Pirque', 23],
            [117, 'San José De Maipo', 23],
            [118, 'Colina', 24],
            [119, 'Lampa', 24],
            [120, 'Tiltil', 24],
            [121, 'San Bernardo', 25],
            [122, 'Buin', 25],
            [123, 'Calera De Tango', 25],
            [124, 'Paine', 25],
            [125, 'Melipilla', 26],
            [126, 'Alhué', 26],
            [127, 'Curacaví', 26],
            [128, 'María Pinto', 26],
            [129, 'San Pedro', 26],
            [130, 'Talagante', 27],
            [131, 'El Monte', 27],
            [132, 'Isla De Maipo', 27],
            [133, 'Padre Hurtado', 27],
            [134, 'Peñaflor', 27],
            [135, 'Rancagua', 28],
            [136, 'Codegua', 28],
            [137, 'Coinco', 28],
            [138, 'Coltauco', 28],
            [139, 'Doñihue', 28],
            [140, 'Graneros', 28],
            [141, 'Las Cabras', 28],
            [142, 'Machali', 28],
            [143, 'Malloa', 28],
            [144, 'Mostazal', 28],
            [145, 'El Olivar', 28],
            [146, 'Peumo', 28],
            [147, 'Pichidegua', 28],
            [148, 'Quinta De Tilcoco', 28],
            [149, 'Rengo', 28],
            [150, 'Requinoa', 28],
            [151, 'San Vicente', 28],
            [152, 'Pichilemu', 29],
            [153, 'La Estrella', 29],
            [154, 'Litueche', 29],
            [155, 'Marchihue', 29],
            [156, 'Navidad', 29],
            [157, 'Paredones', 29],
            [158, 'San Fernando', 30],
            [159, 'Chépica', 30],
            [160, 'Chimbarongo', 30],
            [161, 'Lolol', 30],
            [162, 'Nancagua', 30],
            [163, 'Palmilla', 30],
            [164, 'Peralillo', 30],
            [165, 'Placilla', 30],
            [166, 'Pumanque', 30],
            [167, 'Santa Cruz', 30],
            [168, 'Talca', 31],
            [169, 'Constitución', 31],
            [170, 'Curepto', 31],
            [171, 'Empedrado', 31],
            [172, 'Maule', 31],
            [173, 'Pelarco', 31],
            [174, 'Pencahue', 31],
            [175, 'Río Claro', 31],
            [176, 'San Clemente', 31],
            [177, 'San Rafael', 31],
            [178, 'Cauquenes', 32],
            [179, 'Chanco', 32],
            [180, 'Pelluhue', 32],
            [181, 'Curicó', 33],
            [182, 'Hualañe', 33],
            [183, 'Licantén', 33],
            [184, 'Molina', 33],
            [185, 'Rauco', 33],
            [186, 'Romeral', 33],
            [187, 'Sagrada Familia', 33],
            [188, 'Teno', 33],
            [189, 'Vichuquén', 33],
            [190, 'Linares', 34],
            [191, 'Colbún', 34],
            [192, 'Longaví', 34],
            [193, 'Parral', 34],
            [194, 'Retiro', 34],
            [195, 'San Javier', 34],
            [196, 'Villa Alegre', 34],
            [197, 'Yerbas Buenas', 34],
            [198, 'Chillán', 35],
            [199, 'Bulnes', 35],
            [200, 'Chillán Viejo', 35],
            [201, 'El Carmen', 35],
            [202, 'Pemuco', 35],
            [203, 'Pinto', 35],
            [204, 'Quillón', 35],
            [205, 'San Ignacio', 35],
            [206, 'Yungay', 35],
            [207, 'Quirihue', 36],
            [208, 'Cobquecura', 36],
            [209, 'Coelemu', 36],
            [210, 'Ninhue', 36],
            [211, 'Portezuelo', 36],
            [212, 'Ranquil', 36],
            [213, 'Treguaco', 36],
            [214, 'San Carlos', 37],
            [215, 'Coihueco', 37],
            [216, 'Ñiquén', 37],
            [217, 'San Fabián', 37],
            [218, 'San Nicolás', 37],
            [219, 'Concepción', 38],
            [220, 'Coronel', 38],
            [221, 'Chiguayante', 38],
            [222, 'Florida', 38],
            [223, 'Hualqui', 38],
            [224, 'Lota', 38],
            [225, 'Penco', 38],
            [226, 'San Pedro de la Paz', 38],
            [227, 'Santa Juana', 38],
            [228, 'Talcahuano', 38],
            [229, 'Tomé', 38],
            [230, 'Hualpén', 38],
            [231, 'Lebu', 39],
            [232, 'Arauco', 39],
            [233, 'Cañete', 39],
            [234, 'Contulmo', 39],
            [235, 'Curanilahue', 39],
            [236, 'Los Alamos', 39],
            [237, 'Tirua', 39],
            [238, 'Los Angeles', 40],
            [239, 'Antuco', 40],
            [240, 'Cabrero', 40],
            [241, 'Laja', 40],
            [242, 'Mulchén', 40],
            [243, 'Nacimiento', 40],
            [244, 'Negrete', 40],
            [245, 'Quilaco', 40],
            [246, 'Quilleco', 40],
            [247, 'San Rosendo', 40],
            [248, 'Santa Bárbara', 40],
            [249, 'Tucapel', 40],
            [250, 'Yumbel', 40],
            [251, 'Alto Biobío', 40],
            [252, 'Temuco', 41],
            [253, 'Carahue', 41],
            [254, 'Cunco', 41],
            [255, 'Curarrehue', 41],
            [256, 'Freire', 41],
            [257, 'Galvarino', 41],
            [258, 'Gorbea', 41],
            [259, 'Lautaro', 41],
            [260, 'Loncoche', 41],
            [261, 'Melipeuco', 41],
            [262, 'Nueva Imperial', 41],
            [263, 'Padre Las Casas', 41],
            [264, 'Perquenco', 41],
            [265, 'Pitrufquén', 41],
            [266, 'Pucón', 41],
            [267, 'Saavedra', 41],
            [268, 'Teodoro Schmidt', 41],
            [269, 'Toltén', 41],
            [270, 'Vilcún', 41],
            [271, 'Villarrica', 41],
            [272, 'Cholchol', 41],
            [273, 'Angol', 42],
            [274, 'Collipulli', 42],
            [275, 'Curacautín', 42],
            [276, 'Ercilla', 42],
            [277, 'Lonquimay', 42],
            [278, 'Los Sauces', 42],
            [279, 'Lumaco', 42],
            [280, 'Puren', 42],
            [281, 'Renaico', 42],
            [282, 'Traiguén', 42],
            [283, 'Victoria', 42],
            [284, 'Valdivia', 43],
            [285, 'Corral', 43],
            [286, 'Lanco', 43],
            [287, 'Los Lagos', 43],
            [288, 'Máfil', 43],
            [289, 'Mariquina', 43],
            [290, 'Paillaco', 43],
            [291, 'Panguipulli', 43],
            [292, 'La Unión', 44],
            [293, 'Futrono', 44],
            [294, 'Lago Ranco', 44],
            [295, 'Río Bueno', 44],
            [296, 'Puerto Montt', 45],
            [297, 'Calbuco', 45],
            [298, 'Cochamó', 45],
            [299, 'Fresia', 45],
            [300, 'Frutillar', 45],
            [301, 'Los Muermos', 45],
            [302, 'Llanquihue', 45],
            [303, 'Maullín', 45],
            [304, 'Puerto Varas', 45],
            [305, 'Castro', 46],
            [306, 'Ancud', 46],
            [307, 'Chonchi', 46],
            [308, 'Curaco de Velez', 46],
            [309, 'Dalcahue', 46],
            [310, 'Puqueldón', 46],
            [311, 'Queilén', 46],
            [312, 'Quellón', 46],
            [313, 'Quemchi', 46],
            [314, 'Quinchao', 46],
            [315, 'Osorno', 47],
            [316, 'Puerto Octay', 47],
            [317, 'Purranque', 47],
            [318, 'Puyehue', 47],
            [319, 'Río Negro', 47],
            [320, 'San Juan de la Costa', 47],
            [321, 'San Pablo', 47],
            [322, 'Chaitén', 48],
            [323, 'Futaleufú', 48],
            [324, 'Hualaihue', 48],
            [325, 'Palena', 48],
            [326, 'Coihayque', 49],
            [327, 'Lago Verde', 49],
            [328, 'Aisén', 50],
            [329, 'Cisnes', 50],
            [330, 'Guaitecas', 50],
            [331, 'Cochrane', 51],
            [332, 'O\'Higgins', 51],
            [333, 'Tortel', 51],
            [334, 'Chile Chico', 52],
            [335, 'Río Ibáñez', 52],
            [336, 'Punta Arenas', 53],
            [337, 'Laguna Blanca', 53],
            [338, 'Río Verde', 53],
            [339, 'San Gregorio', 53],
            [340, 'Cabo de Hornos', 54],
            [341, 'Antártica', 54],
            [342, 'Porvenir', 55],
            [343, 'Primavera', 55],
            [344, 'Timaukel', 55],
            [345, 'Natales', 56],
            [346, 'Torres del Paine', 56],
        ];

        $ciudades = array_map(function ($ciudad) {
            return [
                'id' => $ciudad[0],
                'nombre' => $ciudad[1],
                'provincia_id' => $ciudad[2],
            ];
        }, $ciudades);

        Ciudad::insert($ciudades);
    }
}

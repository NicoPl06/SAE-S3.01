/* global L */

document.addEventListener('DOMContentLoaded', function () {

    const map = L.map('map').setView([48.8566, 2.3522], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> - FAGE',
        minZoom: 4,
        maxZoom: 19,
    }).addTo(map);

    const federations = [
        {
            name: "Fédé B - Brest",
            coords: [48.39986783351499, -4.496951273718091],
            desc: "La Fédé B est une association à but non lucratif (loi 1901) âgée de 20 ans. Née sous le nom de « Fédération Brestoise », elle s'appelle depuis plusieurs années maintenant « Fédération des associations étudiantes de Bretagne occidentale ».\n" +
                "\n" +
                "Elle est statutairement une structure fédérative de mutualisation et de représentation au service des associations et des étudiants du Finistère. depuis plusieurs années maintenant « Fédération des associations étudiantes de Bretagne occidentale.Elle est statutairement une structure fédérative de mutualisation et de représentation au service des associations et des étudiants du Finistère.",
            url: "https://fedeb.net/",
            img: "https://www.fage.org/ressources/imageBank/24/210x-6562-FedeBlogo.jpeg",
        },
        {
            name : "FAHB - Fédération des Associations de Haute Bretagne",
            coords: [48.10549511843119, -1.6764033412010184],
            desc: "La FAHB est une association à but non lucratif (loi 1901) créée en octobre 2018. La FAHB, pour Fédération des Associations de Haute Bretagne est une structure fédérative d’associations étudiantes, 17 à ce jour.\n" +
                "\n" +
                "La FAHB permet la mise en commun de savoir associatifs étudiants et est également une structure de représentation par les élus en son sein ; au service des étudiant.e.s et associations d’Ille-et-Vilaine.\n" +
                "\n" +
                "Les élu.e.s de la FAHB sont présent.e.s dans les conseils des universités Rennes 1 et Rennes 2 ainsi qu’au CROUS Bretagne.",
            url: "https://www.fahb.eu/",
            img: "https://www.fage.org/ressources/imageBank/24/560x-6556-FAHB-Logo.png",
        },
        {
          name: "Interasso Nantes",
          coords: [47.211123445529836, -1.5553992492356037],
          desc: "Interasso Nantes est une association loi 1901, à but non lucratif. Fondée en 2012, elle a pour but de fédérer la majorité des associations et élus étudiants de Nantes et sa région.\n" +
              "\n" +
              "Sa victoire lors des éléctions universitaires de février 2014, lui permet d'être la première association représentative des étudiants nantais.",
          url:"https://interassonantes.org/",
          img:"https://www.fage.org/ressources/imageBank/61/310x-7458-IAN.jpeg",
        },
        {
          name: "Fé2A",
          coords: [47.4815500373805, -0.600186431431866],
          desc: "La Fé2A est la Fédération Étudiante des Associations de l’Anjou, basée à Angers mais touchant également des campus extérieurs comme ceux de Cholet ou de Saumur. Fondée en 2003 et forte de ses 9 associations adhérentes, elle s’impose aujourd’hui comme première organisation représentative étudiante de Maine-Et-Loire.",
          url:"https://www.fe2a.fr/",
          img:"https://www.fage.org/ressources/imageBank/63/210x-7482-Logo-Fe2A.gif",
        },
        {
            name: "AFJEM - Le Mans",
            coords: [48.01697370712601, 0.16207764073905398],
            desc: "Association Fédérative des Jeunes et de Etudiants du Mans\n" +
                "\n" +
                "La Fédération des étudiants a pour objectif de dynamiser la vie étudiante par divers projets et défendre le quotidien des jeunes sous toutes ses formes.",
            url: "",
            img:"https://www.fage.org/ressources/_thumbnails/96/90x-6411-Logo-AFJEM-detoure.png",
        },
        {
            name: "Fédération Campus BN",
            coords: [49.1884300761896, -0.3635965895634136],
            desc: "La Fédé Campus BN est une fédération territoriale d'associations étudiantes de Basse-Normandie. Foyer du pluralisme des énergies associatives et indépendante de toute idéologie politique, syndicale et religieuse, son objectif est un meilleur partage entre ces associations et faciliter les échanges entre les étudiants bas-normands...",
            url: "https://www.campusbn.org/",
            img:"https://www.fage.org/ressources/images/91/2944,310x,logo-2015.jpg",
        },
        {
            name: " FEDLH - Le Havre",
            coords: [49.497218708932145, 0.13164611284019828],
            desc: "FEDLH, la fédération des associations étudiantes du Havre",
            url: "https://fedlh.fr/",
            img:"https://www.fage.org/ressources/imageBank/25/210x-6563-logoFEDLH.jpeg",
        },
        {
            name: "FEDER",
            coords: [49.45821069459933, 1.0682580974967664],
            desc: "La FEDER est une association apartisane, nous n'appartenons à aucun mouvement politique et vos élus étudiants sont issus de vos associations.\n" +
                "\n" +
                "Notre fonctionnement est basé sur un modèle de démocratie participative. Nous sommes rattachés à une association nationale la FAGE- Fédération des Associations Générales Etudiantes- que nous administrons. Cela nous permet de faire remonter nos problématiques au niveau national.",
            url: "https://www.feder-rouen.fr/",
            img:"https://www.fage.org/ressources/imageBank/61/310x-7457-FEDER.jpeg",
        },
        {
            name: "FAEP - Picardie",
            coords: [49.877289434499055, 2.269603151492123],
            desc: "La FAEP est une association réalisant des projets dans le milieux de l'Événementiel, la Prévention, la Solidarité ou encore la Représentation et la Défense des étudiants. Pour cela la FAEP continue à entourer, informer et encadrer ses associations pour qu'elles puissent au mieux développer et améliorer à la vie étudiant.",
            url: "https://faep.fr/",
            img:"https://www.fage.org/ressources/imageBank/4/310x-542-30692_126256230739399_5240826_n.jpeg",
        },
        {
            name: "GALILLE - Lille",
            coords: [50.62808937129066, 3.065551594314034],
            desc: "GALILLE - Groupement des Associations Lilloises Étudiantes\n" +
                "\n" +
                "Le Groupement des Associations Lilloises Étudiantes (GALILLÉ) est une fédération étudiante créée en novembre 2020 dans un contexte de crise économique, sociale, écologique et sanitaire qui a cruellement impacté les étudiant.e.s. Le manque de représentation de notre communauté et l'augmentation de la précarité sur le territoire lillois ont amené les bénévoles de notre réseau à se rassembler autour de projets solidaires comme les distributions alimentaires et ainsi à se fédérer pour défendre au mieux la jeunesse.",
            url: "https://www.facebook.com/fedegalille/",
            img:"https://www.fage.org/ressources/imageBank/61/560x-7448-GALILLE-sans-fond.png",
        },
        {
            name: "FEV - Valenciennes",
            coords: [50.36566751580283, 3.5302452212679984],
            desc: "La FEV est la Fédération des Etudiants de Valenciennes, nous sommes une association de loi 1901, à but non lucratif, la FEV a été créée en 1989. Son but est de fédérer les associations étudiantes de Valenciennes.",
            url: "https://la-fev.org/site/",
            img:"https://www.fage.org/ressources/imageBank/5/210x-549-fev-sans-web.png",
        },
        {
            name: "INTERCampus - Champagne-Ardenne",
            coords: [49.237931184670494, 4.000578996395232],
            desc: "INTERCampus a été créé le 11 février 1991. La naissance de cette fédération étudiante trouve son origine dans deux éléments : les élections étudiantes et l'envie d'animation.\n" +
                "\n" +
                "Le dépôt des statuts de l'association INTERCampus se fait rapidement, dès février 1991. Trois objectifs ont été définis à l'époque et sont aujourd'hui toujours d'actualité : la représentation des étudiants, l'animation des campus, la formation des acteurs associatifs\n" +
                "\n",
            url: "https://www.intercampus.fr/",
            img:"https://www.fage.org/ressources/imageBank/97/210x-8108--IC-COMM-Logo-INTERCampus.png",
        },
        {
            name: "FEDELOR - Lorraine",
            coords: [48.69331406742251, 6.167656322921689],
            desc: "La Lorraine est un territoire empreint d'une longue tradition étudiante. C'est en 1877 que la première Assemblée Générale Etudiante de France a vu le jour à Nancy.\n" +
                "\n" +
                "Créée en 2014, Fédélor - Fédération des étudiants de Lorraine - est l'héritière de ce passé et successeuse de la FéDEN (1997-2014). Elle est à l’heure actuelle l'une des plus importantes fédérations de France. En effet, la Lorraine compte différents pôles estudiantins majeurs (Nancy, Metz, Epinal) et porte sur son territoire la seconde plus grande université française.",
            url: "https://www.fedelor.org/wp-signup.php?new=fedelor.org",
            img:"https://www.fage.org/ressources/images/70/2284,310x,logotype_final.jpg",
        },
        {
            name: "AFGES - Alsace",
            coords: [48.58469771388298, 7.760072538252203],
            desc: "L'AFGES - les étudiant-e-s d'Alsace est la plus vieille fédération étudiante encore en activité. Fondée en 1923, elle a développé, à travers ses 100 ans d'histoire, un grand nombre de dispositifs au service des étudiants, aujourd'hui nationalisé ou reconnus d'utilité publique :\n" +
                "\n" +
                "La restauration étudiante, qu'elle a créée à Strasbourg en 1927, au sein du Restaurant Universitaire « la Gallia », qu'elle a géré jusqu'en 2015,\n" +
                "Le sport universitaire, avec la création du Strasbourg Étudiant Club en 1925,\n" +
                "La médecine préventive, crée en 1929 à Strasbourg, elle se retrouve aujourd'hui sur tous les campus de France par le biais des SUMPPS\n" +
                "L'AFGES est, depuis toujours, la 1ère organisation représentative des étudiants d'Alsace. Elle porte la voix des étudiants dans les conseils du CROUS et de l'Université, mais elle porte également la voix des jeunes auprès des politiques publiques ou encore dans d'autres réseaux associatifs.",
            url: "https://afges.org/",
            img:"https://www.fage.org/ressources/images/129/4136,210x,Logo-AFGES-Orange.png",
        },
        {
            name: "FET Campus 3 - Troyes",
            coords: [48.26857445163109, 4.070914180544063],
            desc: "Fédération des Etudiants Troyens - Campus 3",
            url: "",
            img:"https://www.fage.org/ressources/images/156/5039-210x-logo_fed_campus3.png",
        },
        {
            name: "AGATE - Tours",
            coords: [47.3563796308123, 0.7031869770772856],
            desc: "Association Générale des Assos Tourangelles Étudiantes",
            url: "https://www.univ-tours.fr/campus/vie-associative/annuaire-des-associations-etudiantes/association-generale-des-assos-tourangelles-etudiantes",
            img:"https://www.fage.org/ressources/_thumbnails/96/90x-6413-Logo-AGATE-1.jpeg",
        },
        {
            name: "AFEP - Poitiers",
            coords: [46.68169730569854, 0.2648001502134271],
            desc: "L'Association Fédérative des Etudiants du Poitou-Charentes (AFEP) a vu le jour le 18 décembre 2003, fondée par 7 associations étudiantes de Poitiers. En 14 ans, l'AFEP a su développer son réseau et s'imposer comme 1ère organisation étudiante représentative du Poitou-Charentes.",
            url: "https://www.afep-asso.org/",
            img:"https://www.fage.org/ressources/imageBank/61/90x-7450-AFEP-sans-fond.png",
        },
        {
            name: "ATENA - Aquitaine",
            coords: [45.45218920117731, -0.7104388860045115],
            desc: "L'Association Territoriale des EtudiaNts Aquitains",
            url: "https://fede-atena.fr/",
            img:"https://www.fage.org/ressources/imageBank/50/90x-7265-ATENA.png",
        },
        {
            name: "AGEMP - Midi Pyrénées",
            coords: [43.60717348042892, 1.438187480595038],
            desc: "L'Association Générale Étudiante de Midi-Pyrénées - AGEMP est une organisation de jeunesse, représentative, humaniste et militante, fondant son fonctionnement sur la démocratie participative. L’AGEMP réunit les jeunes de Midi Pyrénées dans le respect mutuel de leurs convictions personnelles, philosophiques, morales ou religieuses.",
            url: "https://www.agemp.org/",
            img:"https://www.fage.org/ressources/imageBank/2/310x-1345-AGEMP.png",
        },
        {
            name: "IAA - Avignon",
            coords: [43.9499059388562, 4.815944836451508],
            desc: "La Fédération Inter’asso Avignon a été fondée le 16 avril 2012 et prend la succession de l’Avignon Inter’Associatif Étudiant créée en 2005. Elle est la fédération territoriale des associations étudiantes d’Avignon et de son territoire. Ses actions s’articulent autour de trois axes majeurs : l’animation de la vie étudiante, de la représentation étudiante et des affaires sociales.",
            url: "http://www.interasso-avignon.fr/",
            img:"https://www.fage.org/ressources/_thumbnails/63/90x-200-IAA2017.png",
        },
        {
            name: "FAMI - Ai-Marseille ",
            coords: [43.383537880291776, 5.363123080573788],
            desc: "La fédération Aix-Marseille INTERASSO regroupe toutes les associations étudiantes des différents campus de l'université. Associations qui sont présentent sur ton campus au quotidien.",
            url: "https://fami-fede.fr/",
            img:"https://www.fage.org/ressources/_thumbnails/97/90x-1245-FAMIlogo.png",
        },
        {
            name: "FEDET - Toulon",
            coords: [43.1229801192111, 5.941468009384477],
            desc:"La Fédération des Étudiant•e•sToulonnais•e•s rassemble et fédère autour d'un projet global les associations et étudiant•e•s du territoire varois. Elle a été fondée en septembre 2019 et est, dès sa création, la première organisation représentative des étudiant•e•s à l'Université de Toulon. Elle défend au quotidien les droits des étudiant•e•s, ainsi que des valeurs d'émancipation de la jeunesse, d'accessibilité à l'Enseignement Supérieur et à la Recherche, mais également de lutte contre toute forme de discrimination. Elle est également un moteur de développement et d'accompagnement pour les associations étudiantes du territoire, leur permettant de toujours mieux servir les étudiant•e•svarois•e•s",
            url: "https://fedet.fr/",
            img:"https://www.fage.org/ressources/imageBank/62/90x-7466-FEDET.jpeg",
        },
        {
            name: "FACE 06 - Nice",
            coords: [43.70394988078904, 7.264115707592796],
            desc: "La FACE 06, créée le 22 septembre 2001, est la fédération étudiante qui réunit, de Nice au pôle de Sophia-Antipolis en passant par Cannes et Menton, la majorité des associations étudiantes des diverses filières de l'Université Côte d’Azur et des Grandes Ecoles du département des Alpes-Maritimes.\n" +
                "\n" +
                "La FACE 06 a pour rôle de représenter la société étudiante, de promouvoir les actions associatives, et d'organiser à son échelle de fédération de territoire, des projets et évènements étudiants. Ses objectifs sont de permettre à la communauté étudiante azuréenne de s'épanouir au mieux dans leur vie étudiante.",
            url: "http://www.face06.com/",
            img:"https://www.fage.org/ressources/imageBank/4/90x-541-face06.png",
        },
        {
            name: "IAGA - Grenoble",
            coords: [45.19254805073897, 5.754509929095554],
            desc: "Communauté Université Grenoble Alpes.",
            url: "https://www.interasso.fr/",
            img:"https://www.fage.org/ressources/_thumbnails/46/90x-3562-IAGOlogo.jpeg",
        },
        {
            name: "FASEE - Saint-Etienne",
            coords: [45.42661079415807, 4.392421015549743],
            desc: "La Fédération des Associations de Saint-Etienne Étudiantes regroupe aujourd’hui plus de 30 structures associatives adhérentes ! Un réseau qui œuvre pour la défense des droits des étudiants, et pour l’amélioration de leurs conditions de vie et d’étude.",
            url: "https://fasee.fr/",
            img:"https://www.fage.org/ressources/imageBank/99/90x-8143-Votre-texte-de-paragraphe.png",
        },
        {
            name: "GAELIS - Lyon",
            coords: [45.779546674104814, 4.865783594419882],
            desc: "GAELIS est une association loi 1901, à but non lucratif.",
            url: "https://gaelis.fr/",
            img:"https://www.fage.org/ressources/_thumbnails/14/90x-196-Logo-GAELIS.png",
        },
        {
            name: "FedEA - Auvergne",
            coords: [45.77360390432289, 3.083387723254897],
            desc: "La FedEA est la Fédération Étudiante d'Auvergne",
            url: "http://fedea-etu.org/",
            img:"https://www.fage.org/ressources/_thumbnails/92/90x-1851-FeDEAlogo.jpeg",
        },
        {
            name: "BAF - Besançon",
            coords: [47.24838544777178, 5.988347021552201],
            desc: "La BAF regroupe les associations du territoire.",
            url: "https://baf-fc.fr/",
            img:"https://www.fage.org/ressources/_thumbnails/97/90x-168-logo-baf-1.png",
        },
        {
            name: "FEBIA - Dijon",
            coords: [47.31519528730472, 5.031516035052139],
            desc: "Née du souhait de renouveler le projet fédératif local, la Fédération Étudiante de Bourgogne Inter-Associative est aujourd’hui la première coordination associative bourguignonne de jeunes et étudiant·e·s. Forte d'une présence sur l'ensemble du territoire, la fédération est actrice de l'économie sociale et solidaire et se reconnaît pleinement dans la démarche d'éducation populaire.",
            url: "https://www.febia-bourgogne.fr/",
            img:"https://www.fage.org/ressources/_thumbnails/94/90x-198-3.png",
        },
        {
            name: "Interassos UVSQ - Versailles-St-Quentin",
            coords: [48.77937142938898, 2.0446169947216704],
            desc: "Interassos UVSQ est la fédération des associations actives de l'UVSQ",
            url: "https://www.interassos-uvsq.org/",
            img:"https://www.fage.org/ressources/_thumbnails/70/90x-1247-Logo_Interassos_UVSQ-2017.png",
        },
        {
            name: "FAC - Créteil",
            coords: [48.78837591856132, 2.4447687547006436],
            desc: "La FAC (Fédération des Associations de Créteil) est la Fédération étudiante de l'Université Paris-Est Créteil et du Val de Marne, structure associative indépendante des partis politiques, composée d'étudiants bénévoles.\n" +
                "\n" +
                "\n" +
                "La FAC aujourd'hui, c'est plus de 10 associations étudiantes issues de différentes filières de formation différentes qui travaille ensemble à l'amélioration des conditions de vie et d'études des étudiants de l'UPEC.\n",
            url: "https://www.fac-creteil.fr/",
            img:"https://www.fage.org/ressources/imageBank/61/90x-7452-Logo-FAC-IconeBleuJaune-1.png",
        },
        {
            name: "FAX - Nanterre",
            coords: [48.90372701534062, 2.2135815118193807],
            desc: "Paris-Nanterre",
            url: "https://aca2.parisnanterre.fr/associations/annuaire-des-associations-etudiantes/fax-federation-des-associations",
            img:"https://www.fage.org/ressources/_thumbnails/98/90x-6417-Logo-FAX-JPEG-1.jpeg",
        },
        {
            name: "IAUSPN - Paris Nord",
            coords: [48.95282011639428, 2.337674341942736],
            desc: "InterAsso USPN",
            url: "https://www.facebook.com/interassouspn",
            img:"https://www.fage.org/ressources/imageBank/98/90x-8119-GsPIHuT-_400x400.jpeg",
        },
        {
            name: "AGEP - Paris",
            coords: [48.85586695346103, 2.33132739277889],
            desc: "L'Association Générale des Étudiants de Paris est l'association représentative indépendante des étudiants de Paris.\n" +
                "\n" +
                "L'AGEP est l'héritière de l'antique AGE de Paris, nommée également l'A., qui a perduré de 1884 à 1934. En1888, l'AGEP possède ses propres locaux aux 41-43, rue des Écoles, avec huit salles de bibliothèques, deux salles de lectures, deux salles de conférence, deux salles d'administration et une salle d'arme. Elle se lance également, au lendemain de la première guerre mondiale, dans la réalisation d'œuvres sociales pour les étudiants de Paris avec la création de restaurants universitaires et d'un sanatorium. Elle disparaît en 1934.\n" +
                "\n" +
                "En 2008, des étudiants de l'Université Paris Descartes décident de la refonder, dans l'idéal d'une représentation étudiante profondément réformiste, militante, libre, et indépendante des partis politiques et des syndicats.",
            url: "https://ageparis.org/",
            img:"https://www.fage.org/ressources/imageBank/4/90x-538-Logo_AGEP.png",
        },
        /**
        {
           name:"FER - La Réunion",
           coords: [-20.896100842840323, 55.48039510280776],
           des:"La FER est la Fédération des Etudiants de la Réunion",
           url:"https://www.facebook.com/FER97400/info/?tab=page_info#",
           img:"https://www.fage.org/ressources/_thumbnails/27/90x-2441-90542844_2608172786137820_869831803.jpeg",
        },
        {
            name:"Avenir Etudiant",
            coords: [-17.57694325927906, -149.60914448159497],
            des:"Avenir Etudiant FAGE est une fédération d'associations d'étudiants poursuivant leurs études post-bac en Polynésie française.",
            url:"",
            img:"https://www.fage.org/ressources/_thumbnails/97/90x-6421-NEW-LOGO-AEF.png"
        },

         */
    ];

    federations.forEach((f) => {
        const maxChars = 180; // nombre approximatif de caractères pour 2 lignes
        const needsButton = f.desc.length > maxChars;

        const popupContent = `
    <div class="popup-content">
        <img src="${f.img || 'https://via.placeholder.com/80'}" alt="${f.name}">
        <div class="text">
            <b>${f.name}</b><br>
            <span class="short-desc">${f.desc}</span>
            <span class="full-desc">${f.desc}</span><br>
            ${needsButton ? '<button class="read-more-btn">En savoir plus</button><br>' : ''}
            <a href="${f.url}" target="_blank">Voir la fédération</a>
        </div>
    </div>
    `;

        const marker = L.marker(f.coords).addTo(map);
        marker.bindPopup(popupContent);

        if (needsButton) {
            marker.on('popupopen', function (e) {
                const popupEl = e.popup.getElement();
                const btn = popupEl.querySelector('.read-more-btn');
                const shortDesc = popupEl.querySelector('.short-desc');
                const fullDesc = popupEl.querySelector('.full-desc');

                fullDesc.style.display = 'none';
                shortDesc.style.display = '-webkit-box';

                btn.addEventListener('click', (event) => {
                    event.preventDefault();
                    event.stopPropagation();

                    const expanded = fullDesc.style.display === 'block';
                    if (expanded) {
                        fullDesc.style.display = 'none';
                        shortDesc.style.display = '-webkit-box';
                        btn.textContent = 'En savoir plus';
                    } else {
                        fullDesc.style.display = 'block';
                        shortDesc.style.display = 'none';
                        btn.textContent = 'Réduire';
                    }

                    // recalculer la taille du popup
                    const popup = e.popup;
                    popup._updateLayout();
                    popup._updatePosition();
                });
            });
        }
    });
});



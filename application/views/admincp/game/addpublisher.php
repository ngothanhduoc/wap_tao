<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/admin/assets/js/backend/backend.game.publisher.input.js"></script>

<?php 
$arrQuocgia = Array
(
    0 => 'Ả Rập Saudi (+966)',
    1 => 'Afghanistan (+93)',
    2 => 'Ai Cập (+20)',
    3 => 'Albania (+355)',
    4 => 'Algeria (+213)',
    5 => 'American Samoa (+1)',
    6 => 'Andorra (+376)',
    7 => 'Angola (+244)',
    8 => 'Anguilla (+1)',
    9 => 'Anh Quốc (+44)',
    10 => 'Antarctica (+672)',
    11 => 'Antigua, Barbuda (+1268)',
    12 => 'Argentina (+54)',
    13 => 'Armenia (+374)',
    14 => 'Aruba (+297)',
    15 => 'Ascension (+247)',
    16 => 'Australia (+61)',
    17 => 'Austria (+43)',
    18 => 'Azerbaidijan (+994)',
    19 => 'Ấn Độ (+91)',
    20 => 'Ba Lan (+48)',
    21 => 'Bahamas (+1)',
    22 => 'Bahrain (+973)',
    23 => 'Bangladesh (+880)',
    24 => 'Barbados (+1)',
    25 => 'Belarus (+375)',
    26 => 'Belize (+501)',
    27 => 'Benin (+229)',
    28 => 'Bermuda (+1441)',
    29 => 'Bhutan (+975)',
    30 => 'Bỉ (+32)',
    31 => 'Bolivia (+591)',
    32 => 'Bosnia & Herzegovina (+387)',
    33 => 'Botswana (+267)',
    34 => 'Bồ Đào Nha (+351)',
    35 => 'Brazil (+55)',
    36 => 'Bulgaria (+359)',
    37 => 'Burkina Faso (+226)',
    38 => 'Burundi (+257)',
    39 => 'Các tiểu Vương quốc Ả Rập Thống nhất (+971)',
    40 => 'Cambodia (+855)',
    41 => 'Cameroon (+237)',
    42 => 'Canada (+1)',
    43 => 'Cape Verde (+238)',
    44 => 'Chad (+235)',
    45 => 'Chile (+56)',
    46 => 'Colombia (+57)',
    47 => 'Comoros (+269)',
    48 => 'Costa Rica (+506)',
    49 => 'Cộng hòa Czech (+420)',
    50 => 'Cộng hòa Dominican (+1)',
    51 => 'Cộng hòa Trung Phi (+236)',
    52 => 'Croatia (+385)',
    53 => 'Cyprus (+357)',
    54 => 'Diego Garcia (+246)',
    55 => 'Djibouti (+253)',
    56 => 'Dominica (+1)',
    57 => 'Đài Loan (+886)',
    58 => 'Đan Mạch (+45)',
    59 => 'Đông Timor (+670)',
    60 => 'Đức (+49)',
    61 => 'Ecuador (+593)',
    62 => 'El Salvador (+503)',
    63 => 'Equatorial Guinea (+240)',
    64 => 'Eritrea (+291)',
    65 => 'Estonia (+372)',
    66 => 'Ethiopia (+251)',
    67 => 'French Polynesia (+689)',
    68 => 'Gabon (+241)',
    69 => 'Gambia (+220)',
    70 => 'Georgia (+995)',
    71 => 'Ghana (+233)',
    72 => 'Gibraltar (+350)',
    73 => 'Greenland (+299)',
    74 => 'Grenada (+1473)',
    75 => 'Guadeloupe (+590)',
    76 => 'Guam (+1)',
    77 => 'Guatemala (+502)',
    78 => 'Guiana thuộc Pháp (+594)',
    79 => 'Guinea (+224)',
    80 => 'Guinea-Bissau (+245)',
    81 => 'Guyana (+592)',
    82 => 'Hà Lan (+31)',
    83 => 'Haiti (+509)',
    84 => 'Hàn Quốc (+82)',
    85 => 'Hoa Kỳ (+1)',
    86 => 'Honduras (+504)',
    87 => 'Hồng Kông (+852)',
    88 => 'Hungary (+36)',
    89 => 'Hy Lạp (+30)',
    90 => 'Iceland (+354)',
    91 => 'Indonesia (+62)',
    92 => 'Iran (+98)',
    93 => 'Iraq (+964)',
    94 => 'Ireland (+353)',
    95 => 'Israel (+972)',
    96 => 'Italy (+39)',
    97 => 'Jamaica (+1876)',
    98 => 'Jordan (+962)',
    99 => 'Kenya (+254)',
    100 => 'Khu hành chính/Lãnh thổ Pháp ở Ấn Độ Dương (+262)',
    101 => 'Kiribati (+686)',
    102 => 'Kuwait (+965)',
    103 => 'Kyrgyzstan (+996)',
    104 => 'Lào (+856)',
    105 => 'Latvia (+371)',
    106 => 'Lebanon (+961)',
    107 => 'Lesotho (+266)',
    108 => 'Liberia (+231)',
    109 => 'Liechtenstein (+423)',
    110 => 'Lithuania (+370)',
    111 => 'Luxembourg (+352)',
    112 => 'Macao (+853)',
    113 => 'Macedonia (+389)',
    114 => 'Madagascar (+261)',
    115 => 'Malawi (+265)',
    116 => 'Malaysia (+60)',
    117 => 'Maldives (+960)',
    118 => 'Mali (+223)',
    119 => 'Malta (+356)',
    120 => 'Martinique (+596)',
    121 => 'Mauritania (+222)',
    122 => 'Mauritius (+230)',
    123 => 'Mexico (+52)',
    124 => 'Micronesia (+691)',
    125 => 'Moldova (+373)',
    126 => 'Monaco (+377)',
    127 => 'Mongolia (+976)',
    128 => 'Montenegro (+382)',
    129 => 'Montserrat (+1664)',
    130 => 'Morocco (+212)',
    131 => 'Mozambique (+258)',
    132 => 'Na-uy (+47)',
    133 => 'Nam Phi (+27)',
    134 => 'Namibia (+264)',
    135 => 'Nauru (+674)',
    136 => 'Nepal (+977)',
    137 => 'Netherlands Antilles (+599)',
    138 => 'New Caledonia (+687)',
    139 => 'New Zealand (+64)',
    140 => 'Nga (+7)',
    141 => 'Nhật (+81)',
    142 => 'Nicaragua (+505)',
    143 => 'Niger (+227)',
    144 => 'Nigeria (+234)',
    145 => 'Niue (+683)',
    146 => 'Oman (+968)',
    147 => 'Pakistan (+92)',
    148 => 'Palau (+680)',
    149 => 'Panama (+507)',
    150 => 'Papua New Guinea (+675)',
    151 => 'Paraguay (+595)',
    152 => 'Peru (+51)',
    153 => 'Pháp (+33)',
    154 => 'Phần Lan (+358)',
    155 => 'Philippines (+63)',
    156 => 'Puerto-Rico (+1)',
    157 => 'Qatar (+974)',
    158 => 'Quần đảo Bắc Mariana (+1)',
    159 => 'Quần đảo Cayman (+1345)',
    160 => 'Quần đảo Cook (+682)',
    161 => 'Quần đảo Falkland (+500)',
    162 => 'Quần đảo Faroe (+298)',
    163 => 'Quần đảo Fiji (+679)',
    164 => 'Quần đảo Marshall (+692)',
    165 => 'Quần đảo Solomon (+677)',
    166 => 'Quần đảo Virgin thuộc Anh (+1)',
    167 => 'Quần đảo Virgin thuộc Hoa Kỳ (+1)',
    168 => 'Quốc gia Vatican (+39)',
    169 => 'Reunion (+262)',
    170 => 'Rumani (+40)',
    171 => 'Rwanda (+250)',
    172 => 'Saint Helena (+290)',
    173 => 'Saint Kitts và Nevis (+1)',
    174 => 'Saint Lucia (+1758)',
    175 => 'Saint Pierre và Miquelon (+508)',
    176 => 'Saint Vincent và The Grenadines (+1)',
    177 => 'Samoa (+685)',
    178 => 'San Marino (+378)',
    179 => 'Sao Tome và Principe (+239)',
    180 => 'Senegal (+221)',
    181 => 'Serbia (+381)',
    182 => 'Seychelles (+248)',
    183 => 'Sierra Leone (+232)',
    184 => 'Singapore (+65)',
    185 => 'Slovakia (+421)',
    186 => 'Slovenia (+386)',
    187 => 'Sri Lanka (+94)',
    188 => 'Suriname (+597)',
    189 => 'Swaziland (+268)',
    190 => 'Tajikistan (+992)',
    191 => 'Tanzania (+255)',
    192 => 'Tây Ban Nha (+34)',
    193 => 'Thái Lan (+66)',
    194 => 'Thổ Nhĩ Kỳ (+90)',
    195 => 'Thụy Điển (+46)',
    196 => 'Thụy Sĩ (+41)',
    197 => 'Togo (+228)',
    198 => 'Tokelau (+690)',
    199 => 'Tonga (+676)',
    200 => 'Trinidad, Tobago (+1868)',
    201 => 'Trung Quốc (+86)',
    202 => 'Tunisia (+216)',
    203 => 'Turkmenistan (+993)',
    204 => 'Turks và Caicos (+1649)',
    205 => 'Tuvalu (+688)',
    206 => 'Uganda (+256)',
    207 => 'Ukraine (+380)',
    208 => 'Uruguay (+598)',
    209 => 'Uzbekistan (+998)',
    210 => 'Vanuatu (+678)',
    211 => 'Venezuela (+58)',
    212 => 'Việt Nam (+84)',
    213 => 'Vương quốc Hồi giáo Brunei (+673)',
    214 => 'Wallis và Futuna (+681)',
    215 => 'Yemen (+967)',
    216 => 'Zambia (+260)',
    217 => 'Zimbabwe (+263)',
);

$arrFlip = array_flip($arrQuocgia);

?>


<div class="pageheader notab">
	<h1 class="pagetitle">Add Publisher</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<form class="stdform stdform2" id="frm-add-game-publisher" role="form" action="" method="POST" enctype="multipart/form-data">
				
		<div style="border: #ddd solid 1px">
                    <label>Quốc gia <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                            <div id="jqxDropdownlistCountry" name="id_country"></div>
                            <div id="id_country" style="color: #ff0000"></div>
                    </span>
		</div>
            
                <p>
			<label for="full_name">Full name <span style="color:#ff0000">(*)</span></label>
			<span class="field">
                            <input type="text" placeholder="" id="full_name" name="full_name" class="mediuminput" autocomplete="off" style="width: 50%; height: 27px" value="<?php echo @$data['full_name']?>">
			</span>
		</p>
		<?php /*
		<p>
			<label for="address">Address <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="address" name="address" class="mediuminput" value="<?php echo @$data['address']?>">
			</span>
		</p>
		<p>
			<label for="phone">Phone <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="phone" name="phone" class="mediuminput" value="<?php echo @$data['phone']?>">
			</span>
		</p>
                 * 
                 */
                ?>
		<p>
                    <label for="home_image_wap">Logo <span style="color:#ff0000"></span></label>
                    <span class="field">
                        <input type="text" placeholder="Click vào để chọn hình" id="logo" name="logo" class="mediuminput" value="<?php echo @$data['logo']?>" onclick="openKCFinderByPath('#logo', 'images')" readonly>
                    </span>
		</p>
			
		<p>
			<label for="website">Website</label>
			<span class="field">
				<input type="text" placeholder="" id="website" name="website" class="mediuminput" value="<?php echo @$data['website']?>">
			</span>
		</p>
			
		
		<p>
			<label for="note" style="float: none">Note</label>
		</p>
		<p>
			<textarea placeholder="" id="note" name="note" class="mediuminput"><?php echo @$data['note']?></textarea>
		</p>
			
		<p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_publisher']?>" name="id">
			<button class="submit radius2" type="submit">Add Publisher</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
		</p>
		
	</form>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('game');
    setActiveSubMenu('backend-game-addpublisher');
    
    
    var QG_NAME = '<?php echo @$arrQuocgia[$data['id_country']]?>';
    var arrQuocgia = <?php echo @json_encode($arrQuocgia)?>;
    var arrQuocgiaName = <?php echo @json_encode($arrFlip)?>;
    var arrPublisher = <?php echo @json_encode($arrPublisher) ?>;
</script>

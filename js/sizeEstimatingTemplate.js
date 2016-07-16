//@Author: Mark Genesis T. Romantigue
//email:markg.romantigue@gmail.com
//version 1.0

var i=7;
function addRow(){
    $('#myTable tr.addMore').before("<tr style='height: 35px;'><td style='width: 284px; height: 35px;'><input type='text' name='BA[]' id='base" + i + "' style='width: 280px;' data-validation='required' data-validation-depends-on='total" + i + "'></td><td style='width: 31px; height: 35px;'><p>&nbsp;</p></td><td style='width: 139px; height: 35px;'><center><select name='type[]' id='x" + i + "'  data-validation='required' data-validation-depends-on='base" + i + "'><option value='' disabled selected>Select type</option><option value='logic'>Logic</option><option value='io'>Input/Output</option><option value='calculation'>Calculation</option><option value='text'>Text</option><option value='data'>Data</option><option value='setup'>Set-Up</option></select></center></td><td style='width: 31px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='width: 139px; height: 35px;'><input type='text' name='methods[]' id='item" + i + "'></td><td style='width: 31px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='width: 171px; height: 35px;'><center><select name='size[]' id='y" + i + "' data-validation='required' data-validation-depends-on='x" + i + "'><option value='' disabled selected>Select Size</option><option value='verysmall'>Very Small</option><option value='small'>Small</option><option value='medium'>Medium</option><option value='large'>Large</option><option value='verylarge'>Very Large</option></select></center></td><td style='width: 10px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='idth: 156px; height: 35px;'><input type='text' name='loc[]' class='toAdd' id='total" + i + "'  data-validation='required' data-validation-depends-on='y" + i + "'></td></tr>");
    i++;
}
function addObjectRow(){
    $('#myTable tr.addMoreObjectRow').before("<tr style='height: 35px;'><td style='width: 284px; height: 35px;'><input type='text' name='NO[]' id='base" + i + "' style='width: 280px;' data-validation='required' data-validation-depends-on='total" + i + "'></td><td style='width: 31px; height: 35px;'><p>&nbsp;</p></td><td style='width: 139px; height: 35px;'><center><select name='type2[]' id='x" + i + "' data-validation='required' data-validation-depends-on='base" + i + "'><option value='' disabled selected>Select type</option><option value='logic'>Logic</option><option value='io'>Input/Output</option><option value='calculation'>Calculation</option><option value='text'>Text</option><option value='data'>Data</option><option value='setup'>Set-Up</option></select></center></td><td style='width: 31px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='width: 139px; height: 35px;'><input type='text' name='methods2[]' id='item" + i + "'></td><td style='width: 31px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='width: 171px; height: 35px;'><center><select name='size2[]' id='y" + i + "' data-validation='required' data-validation-depends-on='x" + i + "'><option value='' disabled selected>Select Size</option><option value='verysmall'>Very Small</option><option value='small'>Small</option><option value='medium'>Medium</option><option value='large'>Large</option><option value='verylarge'>Very Large</option></select></center></td><td style='width: 10px; height: 35px;'><p><strong>&nbsp;</strong></p></td><td style='idth: 156px; height: 35px;'><input type='text' name='loc2[]' class='toAdd2' id='total" + i + "' data-validation='required' data-validation-depends-on='y" + i + "'></td></tr>");
    i++;
}
$(document).on('click','.toAdd',function() {
    $('.toAdd').keyup(function() {
        var result = 0;
        var P = 0;
        $('#totalBA').attr('value', function() {
            $('.toAdd').each(function() {
                if ($(this).val() !== '') {
                    result += parseFloat($(this).val());
                }
            });
            return result;
        });
        $('#P').attr('value', function() {
            $('#totalBA, #totalNO').each(function() {
                if ($(this).val() !== '') {
                    P += parseFloat($(this).val());
                }
            });
            return P;
        });
        $('#totalR').attr('value', 0);
        $('#P').trigger('keyup');
    });
});
$(document).on('click','.toAdd2',function() {
    $('.toAdd2').keyup(function() {
        var result = 0;
        var P = 0;
        $('#totalNO').attr('value', function() {
            $('.toAdd2').each(function() {
                if ($(this).val() !== '') {
                    result += parseFloat($(this).val());
                }
            });
            return result;
        });
        $('#P').attr('value', function() {
            $('#totalNO, #totalBA').each(function() {
                if ($(this).val() !== '') {
                    P += parseFloat($(this).val());
                }
            });
            return P;
        });
        $('#P').trigger('keyup');
    });
});
$(document).on('click','.toAdd3',function() {
    $('.toAdd3').keyup(function() {
        var result = 0;
        $('#totalR').attr('value', function() {
            $('.toAdd3').each(function() {
                if ($(this).val() !== '') {
                    result += parseFloat($(this).val());
                }
            });
            return result;
        });
        $('#totalR').trigger('keyup');
    });
});
$( document ).ready(function() {
    $('#M,#P,#b0,#b1').keyup(function() {
        var result = 0;
        $('#N').attr('value', function() {
            if ($('#M').val() !== '' && $('#P').val() !== '' && $('#b0').val() !== '' && $('#M').val() !== '') {
                result = parseFloat($('#b0').val()) + parseFloat($('#b1').val()) * (parseFloat($('#P').val()) + parseFloat($('#M').val()));
            }else{
                result=0;
            }
            return result;
        });
        $('#N').trigger('keyup');
    });
});
$( document ).ready(function() {
    $('#N,#B,#D,#M,#totalR').keyup(function() {
        var result = 0;
        $('#T').attr('value', function() {
            result = parseFloat($('#N').val()) + parseFloat($('#B').val()) - parseFloat($('#D').val()) - parseFloat($('#M').val()) + parseFloat($('#totalR').val());
            return result;
        });
    });
});
$( document ).ready(function() {
    $(document).on('change', '[id^=x],[id^=y]', function(){
        var result = 0;
        if($(this).is(':contains("x")')){
            var num = this.id.split('x')[1];
        }else if($(this).is(':contains("y")')){
            var num = this.id.split('y')[1];
        }
        $('#total' + num).val(function() {
            var items = $('#item'  + num).val();
            if(items == 0){
                items=1;
            }
            if ($('#x' + num).val() == "logic" && $('#y' + num).val() == "verysmall") {
                result = 7.55 * items;
            }else if ($('#x' + num).val() == "logic" && $('#y' + num).val() == "small") {
                result = 10.98 * items;
            }else if ($('#x' + num).val() == "logic" && $('#y' + num).val() == "medium") {
                result = 15.98 * items;
            }else if ($('#x' + num).val() == "logic" && $('#y' + num).val() == "large") {
                result = 23.25 * items;
            }else if ($('#x' + num).val() == "logic" && $('#y' + num).val() == "verylarge") {
                result = 33.83 * items;
            }else if ($('#x' + num).val() == "io" && $('#y' + num).val() == "verysmall") {
                result = 9.01 * items;
            }else if ($('#x' + num).val() == "io" && $('#y' + num).val() == "small") {
                result = 12.06 * items;
            }else if ($('#x' + num).val() == "io" && $('#y' + num).val() == "medium") {
                result = 16.15 * items;
            }else if ($('#x' + num).val() == "io" && $('#y' + num).val() == "large") {
                result = 21.62 * items;
            }else if ($('#x' + num).val() == "io" && $('#y' + num).val() == "verylarge") {
                result = 28.93 * items;
            }else if ($('#x' + num).val() == "calculation" && $('#y' + num).val() == "verysmall") {
                result = 2.34 * items;
            }else if ($('#x' + num).val() == "calculation" && $('#y' + num).val() == "small") {
                result = 5.13 * items;
            }else if ($('#x' + num).val() == "calculation" && $('#y' + num).val() == "medium") {
                result = 11.25 * items;
            }else if ($('#x' + num).val() == "calculation" && $('#y' + num).val() == "large") {
                result = 24.66 * items;
            }else if ($('#x' + num).val() == "calculation" && $('#y' + num).val() == "verylarge") {
                result = 54.04 * items;
            }else if ($('#x' + num).val() == "text" && $('#y' + num).val() == "verysmall") {
                result = 3.75 * items;
            }else if ($('#x' + num).val() == "text" && $('#y' + num).val() == "small") {
                result = 8.00 * items;
            }else if ($('#x' + num).val() == "text" && $('#y' + num).val() == "medium") {
                result = 17.07 * items;
            }else if ($('#x' + num).val() == "text" && $('#y' + num).val() == "large") {
                result = 36.41 * items;
            }else if ($('#x' + num).val() == "text" && $('#y' + num).val() == "verylarge") {
                result = 77.66 * items;
            }else if ($('#x' + num).val() == "data" && $('#y' + num).val() == "verysmall") {
                result = 2.60 * items;
            }else if ($('#x' + num).val() == "data" && $('#y' + num).val() == "small") {
                result = 4.79 * items;
            }else if ($('#x' + num).val() == "data" && $('#y' + num).val() == "medium") {
                result = 8.84 * items;
            }else if ($('#x' + num).val() == "data" && $('#y' + num).val() == "large") {
                result = 16.31 * items;
            }else if ($('#x' + num).val() == "data" && $('#y' + num).val() == "verylarge") {
                result = 30.09 * items;
            }else if ($('#x' + num).val() == "setup" && $('#y' + num).val() == "verysmall") {
                result = 3.88 * items;
            }else if ($('#x' + num).val() == "setup" && $('#y' + num).val() == "small") {
                result = 5.04 * items;
            }else if ($('#x' + num).val() == "setup" && $('#y' + num).val() == "medium") {
                result = 6.56 * items;
            }else if ($('#x' + num).val() == "setup" && $('#y' + num).val() == "large") {
                result = 8.53 * items;
            }else if ($('#x' + num).val() == "setup" && $('#y' + num).val() == "verylarge") {
                result = 11.09 * items;
            }
        return result.toFixed(2);
        });
        $('.toAdd, .toAdd2').trigger('click');
        $('.toAdd, .toAdd2').trigger('keyup');
    });
});
$(document).on('click', '[id^=item]', function(){
    var num = this.id.split('item')[1];
    $('#item' + num).keyup(function() {
        $('#x' + num).trigger('change');
        $('#y' + num).trigger('change');
    });
});
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Matemática de audio</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}
</style>

<script>
var vsound = 340;

function midiToF (Atext, form) {
  var A = parseFloat(Atext);
	var semiToneRatio = Math.pow(2, 1/12.0);
	var c5 = 220.0 * Math.pow(semiToneRatio, 3);
	var c0 = c5 * Math.pow(0.5, 5);
	var midinote = parseFloat(Atext);
	form.freq.value = c0 * Math.pow(semiToneRatio, midinote);
}

function freqToLong(freq, form) {
	//var B = parseFloat(Btext);
	var waveLenght = vsound / freq;
	var quarterWaveLenght = waveLenght / 4;
	form.LongFreq.value = waveLenght;
  form.waveLenghtTime.value = 1 / freq;
	form.quarterWavelenghtDistance.value = waveLenght / 4;
	form.quarterWavelenghtTime.value = (quarterWaveLenght * 1000) / vsound;
}

function endFire(Ctext, form) {
	var C = parseFloat(Ctext);

	form.endFireDelay0.value = 0;
	form.endFireDelay1.value = (C*1000) / vsound;
	endFireDelay1 = (C*1000) / vsound;
	form.endFireDelay2.value = endFireDelay1 * 2;
	form.endFireDelay3.value = endFireDelay1 * 3;
	form.endFireDelay4.value = endFireDelay1 * 4;
	form.endFireDelay5.value = endFireDelay1 * 5;
	form.endFireDelay6.value = endFireDelay1 * 6;
}

function metersToTime(meters, form){
  form.metersTime.value = (meters*1000) / vsound;
}


function timeToMeters(Dtext, form) {
	var D = parseFloat(Dtext);
  form.timeMeters.value = (D/1000) * vsound;
  form.endFireDelay1.value = (D/1000) * vsound;
}

function timeToPhase(freq, phase, form) {
  form.time.value = 1/freq*(phase/360)*1000;
  }

var exec = require('child_process').exec;
exec('sox -m 1.wav 2.wav 3.wav mix.wav', function (error, stdout, stderr) {
  // output is in stdout
});
// - End of Jav-.cr... + m->
</script>



<pre>	...m...... -.....   ....
	      .- +..m-m.m- -.m-	-+.-+...
Para sonido 	     . m*#*%-+#m*%%#+m+-**+m.+.-.%
    a: 340 mts/sg	     -...+.m-...-..*+mm.%#m*+%m.-.
	      .....+ -.	 ..-  -.-..* m.--
	       .. .  ..	..-m...-+ -.. +.. .
                                         +-+.   .+.-

</pre>
<FORM>
<p>Escriba una frecuencia:
    <INPUT NAME="freq" TYPE=text SIZE=5>Hertz

    <INPUT NAME="submit" TYPE=Button VALUE="Calcule" onClick="freqToLong(this.form.freq.value, this.form)"><br><br><br>

    <INPUT NAME="LongFreq" TYPE=text SIZE=5>Mts. Longitud de onda     <img src ="http://jardincosmico.net/files/unloquer/waveLenght.gif"><br><br>
    <INPUT NAME ="waveLenghtTime" TYPE=text SIZE=5>ms. un período ?<br><br><br>
    <hr>
    <b> Para sub cardioide:</b><br>
    Separe los subs <INPUT NAME="quarterWavelenghtDistance" TYPE=text SIZE=5> Metros (1/4 tiempo) <br>
    Agregue <INPUT NAME="quarterWavelenghtTime" TYPE=text SIZE=5> milisegundos de retraso(delay) al sub de atrás, la polaridad se puede invertir en cualquiera de los dos.
    <br>
</FORM>
<hr>
<FORM>
<!-- Desplazamiento de Fase según un tiempo y frecuencia -->
  <p>
  Frecuencia <INPUT NAME="freq2" TYPE=text SIZE=5> Hz,  Desplazamiento  <INPUT NAME="phase" TYPE=text SIZE=5> grados.
  <INPUT NAME="submit" TYPE=Button VALUE="Desplazamiento de Fase en tiempo" onClick="timeToPhase(this.form.freq2.value, this.form.phase.value, this.form)"> <INPUT NAME="time" TYPE=text SIZE=5>ms.
</P>
</FORM>
<hr>
<FORM>
<pre>
  Retrazos para End Fire a <INPUT NAME="endFireDistance" TYPE=text SIZE=2 > mt.
  <INPUT NAME="submit" TYPE=Button VALUE="Calcule" onClick="endFire(this.form.endFireDistance.value, this.form)">
  <INPUT NAME="endFireDelay0" TYPE=text SIZE=5>ms.
  <INPUT NAME="endFireDelay1" TYPE=text SIZE=5>ms.
  <INPUT NAME="endFireDelay2" TYPE=text SIZE=5>ms.
  <INPUT NAME="endFireDelay3" TYPE=text SIZE=5>ms.
  <INPUT NAME="endFireDelay4" TYPE=text SIZE=5>ms.
  <INPUT NAME="endFireDelay5" TYPE=text SIZE=5>ms.
  <INPUT NAME="endFireDelay6" TYPE=text SIZE=5>ms.
</P>
</pre>
</FORM>
<hr>
<FORM>
  <pre>
  +----------------------+
  |  Alinear demorados   |
  +----------------------+
  </pre>
  <P>
    De Distancia a Tiempo  --->  Para
    <INPUT NAME="meters" TYPE=text SIZE=5> metros
    <INPUT NAME="submit" TYPE=Button VALUE="Dame tiempo" onClick="metersToTime(this.form.meters.value, this.form)">
    <INPUT NAME="metersTime" TYPE=text SIZE=5>milisegundos
  </P>
  <P>
    De Tiempo a Distancia ---> Para
    <INPUT NAME="time1" TYPE=text SIZE=5> Milisegundos
    <INPUT NAME="submit" TYPE=Button VALUE="Dame metros" onClick="timeToMeters(this.form.time1.value, this.form)">
    <INPUT NAME="timeMeters" TYPE=text SIZE=5>Metros</P>
  </P>
  <BR>
  <hr>
  <!-- Conversiones MIDI -->
  <p>
    Numero Nota MIDI:
    <INPUT NAME="notamidi" TYPE=text SIZE=3 PLACEHOLDER="Nota Midi">
    <INPUT NAME="submit" TYPE=Button VALUE="Frecuencia" onClick="midiToF(this.form.notamidi.value, this.form)">
    <INPUT NAME="freq" TYPE=text  SIZE=5>Hertz
  </P>
</FORM>
<hr>
<pre>
-------\
   -- 	       ---------------\
     \--  Arreglos de subs     ---------
        \---  		    /-------
            \--     /-------
	       \----
</pre>
<P>
  Retrazos para End Fire a 1 mt. (incrementos de 2.9ms): 0ms -- 2.9ms -- 5.8ms -- 8.7ms
<P>
  Visualización: <a href="http://bobmccarthy.wordpress.com/2010/04/15/phase-wavelengths-the-end-fire-cardioid-array-made-visible/">http://bobmccarthy.wordpress.com/2010/04/15/phase-wavelengths-the-end-fire-cardioid-array-made-visible/</a></p>

  punto de partida para hacer un arco de subs :
	tomado de:<a href="http://www.electrovoice.com/sitefiles/downloads/wp%20-%20Subwoofer%20Arrays%20v04%20.pdf">http://www.electrovoice.com/sitefiles/downloads/wp%20-%20Subwoofer%20Arrays%20v04%20.pdf</a>

<ul>Delay values,
  Left to right
  <li>12 mSec</li>
  <li>7 mSec</li>
  <li>4 mSec</li>
  <li>2 mSec</li>
  <li>1 mSec</li>
  <li>0 mSec</li>
  <li>0 mSec</li>
  <li>1 mSec</li>
  <li>2 mSec</li>
  <li>4 mSec</li>
  <li>7 mSec</li>
  <li>12 mSec</li></ul>
<p>
<a href="mix.wav"> mix.wav</a>

</body>
</html>

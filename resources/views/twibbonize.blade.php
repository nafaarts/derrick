@extends('_layouts.main')

@section('title', 'Twibbonize')

@section('body')
    <div class="flex h-[80vh] w-full items-center justify-center bg-TERTIARY">
        <div class="flex h-3/4 w-3/4 flex-col rounded-md bg-PRIMARY shadow-sm md:w-1/2 lg:w-1/3">
            <h5 class="my-2 text-center uppercase tracking-wider text-HEADINGTEXT font-bold">Twibbonize</h5>
            <textarea disabled id="caption-sample" cols="30" rows="10" class="w-full flex-1 border p-2 text-xs">
        🚨 ALERT: THE BIGGEST ANNUAL EVENT INTERNATIONAL OIL AND GAS COMPETITION IS BACK!!! 🚨

  Halo Future Engineers!👷🏻‍♀️👷🏼‍♂️

  Hello my name is (name) from (university) ready to strive at (competition name) in DERRICK 2022!‼

  DERRICK is an annual international competition held by @hima_ep @spepemakamigassc and @iatmi_akamigas.sm also supported by PEM Akamigas Cepu, Ministry of Energy and Mineral Resources Republic of Indonesia, SKK Migas, SPE Java Section, and IATMI Pusat.

  This year, DERRICK 2022 bring theme "Riposting to Future Energy Challenges by Developing Human-Intellectual Centered on Technological Innovation", with 8 competitions. So let's register yourself at www.derrick.id

  See you in September, we look forward to your spirit in Petroleum Motherland👋

  Follow Our Official Social Media:
  📷 IG: @derrick2k22
  📩 LINE : @mng1518e
  📧 Email : derrickeksplorasiproduksi@gmail.com
  🔍 LinkedIn : DERRICK PEM Akamigas Cepu
  🌐 Website :  http://www.derrick.id

  #DERRICK2022
  #BracingForImpact
  #DERRICKMAN2022

  (dont forget to tag us at @derrick2k22, also at least your three friends!)
      </textarea>
            <div class="flex text-xs">
                <button onclick="copyTextToClipboard(document.getElementById('caption-sample').value)"
                    class="mx-1 my-2 box-border block w-full rounded-md py-2 text-center text-SECONDARY"><i
                        class="fas fa-fw fa-clipboard"></i> Copy caption</button>
                <a href="https://twb.nz/derrick2022" target="_blank"
                    class="mx-1 my-2 box-border block w-full rounded-md bg-SECONDARY py-2 text-center text-white"><i
                        class="fas fa-fw fa-camera"></i> Create
                    yours!!</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function fallbackCopyTextToClipboard(text) {
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                Swal.fire(successful ? 'Good job!' : 'Oops...', 'Copying text command was ' + msg, successful ? 'success' :
                    'error'
                )
            } catch (err) {
                Swal.fire('Oops...', 'Oops, unable to copy ' + msg, 'error')
            }
        }

        function copyTextToClipboard(text) {
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(text);
                return;
            }
            navigator.clipboard.writeText(text).then(function() {
                Swal.fire('Good job!', 'Copying to clipboard was successful!', 'success')
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
                Swal.fire('Good job!', 'Could not copy text: ' + err, 'success')
            });
        }
    </script>
@endsection

<div x-data="beer()" x-init="start()" class="w-full flex justify-center items-center h-full">
    <div class="text-yellow-100">
        <h1 class="text-3xl text-center mb-10 font-extralight">WE ARE <strong>COMING SOON</strong>!</h1>
        <div class="text-lg md:text-6xl text-center flex w-full items-center justify-center">
            <div class="w-fit md:w-24 mx-1 p-2 bg-white text-yellow-500 rounded-lg">
                <div class="leading-none" x-text="days">00</div>
                <div class="uppercase text-xs md:text-sm">Days</div>
            </div>
            <div class="w-fit md:w-24 mx-1 p-2 bg-white text-yellow-500 rounded-lg">
                <div class="leading-none" x-text="hours">00</div>
                <div class="uppercase text-xs md:text-sm">Hours</div>
            </div>
            <div class="w-fit md:w-24 mx-1 p-2 bg-white text-yellow-500 rounded-lg">
                <div class="leading-none" x-text="minutes">00</div>
                <div class="uppercase text-xs md:text-sm">Minutes</div>
            </div>
            <div class="w-fit md:w-24 mx-1 p-2 bg-white text-yellow-500 rounded-lg">
                <div class="leading-none" x-text="seconds">00</div>
                <div class="uppercase text-xs md:text-sm">Seconds</div>
            </div>
        </div>
        <h5 class="text-center mt-10">"Riposting to Future Energy Challanges by Developing Human-Intellectual
            Centered
            on Technological Innovation"</h5>
    </div>
</div>

@section('scripts')
    <script>
        function beer() {
            return {
                seconds: '00',
                minutes: '00',
                hours: '00',
                days: '00',
                distance: 0,
                countdown: null,
                beerTime: new Date('{{ $countdown }}').getTime(),
                now: new Date().getTime(),
                start: function() {
                    this.countdown = setInterval(() => {
                        // Calculate time
                        this.now = new Date().getTime();
                        this.distance = this.beerTime - this.now;
                        // Set Times
                        this.days = this.padNum(Math.floor(this.distance / (1000 * 60 * 60 * 24)));
                        this.hours = this.padNum(Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 *
                            60 * 60)));
                        this.minutes = this.padNum(Math.floor((this.distance % (1000 * 60 * 60)) / (1000 *
                            60)));
                        this.seconds = this.padNum(Math.floor((this.distance % (1000 * 60)) / 1000));
                        // Stop
                        if (this.distance < 0) {
                            clearInterval(this.countdown);
                            this.days = '00';
                            this.hours = '00';
                            this.minutes = '00';
                            this.seconds = '00';
                        }
                    }, 100);
                },
                padNum: function(num) {
                    var zero = '';
                    for (var i = 0; i < 2; i++) {
                        zero += '0';
                    }
                    return (zero + num).slice(-2);
                }
            }
        }
    </script>
@endsection

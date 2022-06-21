<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CompetitionRegisterController;
use App\Http\Controllers\CompetitionRegistrantController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegisterController;
use App\Http\Controllers\EventRegistrantController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TransactionController;
use App\Models\Blog;
use App\Models\Committee;
use App\Models\Competition;
use App\Models\Event;
use App\Models\EventRegistrant;
use App\Models\Gallery;
use App\Models\Registrant;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $countdown = env('COUNTDOWN_SHOW') ? env('COUNTDOWN_SET') : "";

    $competitions = Competition::where('status', 1)->latest()->get();
    $events = Event::all();
    $preEvent = $events->where('category', 'PRE')->where('status', 1)->where('start_date', '>', date('Y-m') . '-00')->slice(0, 4);
    $postEvent = $events->where('category', 'POST')->where('status', 1)->all();
    $blogs = Blog::where('status', 'published')->latest()->limit(3)->get();

    $sponsors = Sponsor::all();
    $supported = $sponsors->where('status', 1)->where('type', 'supported')->all();
    $organized = $sponsors->where('status', 1)->where('type', 'organized')->all();

    $crews = Committee::all();

    return view('home', compact('preEvent', 'postEvent', 'competitions', 'blogs', 'supported', 'organized', 'crews', 'countdown'));
})->name('home');

Route::get('/events', function () {
    $competitions = Competition::where('status', 1)->latest()->get();
    $events = Event::all();
    $preEvent = $events->where('category', 'PRE')->where('status', 1)->all();
    $postEvent = $events->where('category', 'POST')->where('status', 1)->all();
    return view('events', compact('preEvent', 'postEvent', 'competitions'));
})->name('events');

Route::group(['prefix' => 'event'], function () {
    Route::get('/{event:slug}', function (Event $event) {
        $event->update(['views' => $event->views + 1]);
        return view('detail-event', compact('event'));
    })->name('event.detail');

    Route::get('/{event:slug}/register', [EventRegisterController::class, 'index'])->name('event.register');
    Route::post('/{event:slug}/register', [EventRegisterController::class, 'register'])->name('event.register');

    Route::get('/{event:slug}/thank-you', function (Event $event) {
        $name = $event->name;
        $category = "event";
        $link = $event->wa_link;
        return view('thankyou', compact('name', 'category', 'link'));
    })->name('event.registered');
});

Route::group(['prefix' => 'competition'], function () {
    Route::get('/{competition:slug}', [CompetitionRegisterController::class, 'index'])->name('competition.detail');
    Route::get('/{competition:slug}/register', [CompetitionRegisterController::class, 'form'])->name('competition.register')->middleware(['auth', 'verified']);
    Route::post('/{competition:slug}/register', [CompetitionRegisterController::class, 'register'])->name('competition.register')->middleware(['auth', 'verified']);

    Route::get('/{competition:slug}/thank-you', function (Competition $competition) {
        $message = "";
        if (in_array(request()->transaction_status, ['settlement', 'pending'])) {
            $message = request()->transaction_status == 'settlement' ? 'Your payment has been successfully processed.' : 'Your payment is being processed.';
        }

        $name = $competition->name;
        $category = "";
        return view('thankyou', compact('name', 'category', 'message'));
    })->name('competition.registered')->middleware(['auth', 'verified']);
});

Route::get('/checkout', [CompetitionRegisterController::class, 'checkout'])->name('competition.checkout')->middleware(['auth', 'verified']);
Route::post('/checkout', [CompetitionRegisterController::class, 'callback'])->name('checkout.callback')->middleware(['auth', 'verified']);

Route::get('/information', function () {
    $blogs = Blog::where('status', 'published')->latest()->get();
    return view('blogs', compact('blogs'));
})->name('blogs');

Route::get('/info/{blog:slug}', function (Blog $blog) {
    $blog->update(['views' => $blog->views + 1]);
    return view('blogs-read', compact('blog'));
})->name('blog.read');

Route::get('/gallery', function () {
    $galleries = Gallery::latest()->get();
    return view('gallery', compact('galleries'));
})->name('gallery');

Route::get('/sponsors', function () {
    $sponsors = Sponsor::all();
    $gold = $sponsors->where('status', 1)->where('sponsor_category', 'gold')->all();
    $silver = $sponsors->where('status', 1)->where('sponsor_category', 'silver')->all();
    $bronze = $sponsors->where('status', 1)->where('sponsor_category', 'bronze')->all();
    return view('sponsor', compact('gold', 'silver', 'bronze'));
})->name('sponsors');

Route::get('/about-us', function () {
    $crews = Committee::all();
    $sponsors = Sponsor::all();
    $supported = $sponsors->where('type', 'supported')->all();
    $organized = $sponsors->where('type', 'organized')->all();
    return view('about', compact('crews', 'supported', 'organized'));
})->name('about');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            $competition = Competition::all()->count();
            $event = Event::all()->count();
            $competition_registrant = Registrant::latest()->get();
            $event_registrant = EventRegistrant::latest()->get();
            return view('admin.dashboard.index', compact('competition', 'event', 'competition_registrant', 'event_registrant'));
        } else {
            $registers = Registrant::where('user_id', auth()->id())->first();
            $alert = [];
            if ($registers) {
                if (!$registers->isPaid())
                    array_push(
                        $alert,
                        'You have not paid for your registration. Please pay your registration fee to continue.'
                    );

                if (!$registers->user->profile_picture)
                    array_push(
                        $alert,
                        'You have not uploaded your profile picture. Please upload your profile picture to continue.'
                    );

                if ($registers->members->count() < $registers->competition->max_member)
                    array_push(
                        $alert,
                        'Please add more member to your team.'
                    );
            }

            return view('registrant.dashboard.index', compact('registers', 'alert'));
        }
    })->name('dashboard');

    Route::get('/registers', [SearchController::class, 'search'])->name('search');

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('/gallery', GalleryController::class)->except('show');
        Route::resource('/blog', BlogController::class)->except('show');

        Route::resource('/competition', CompetitionController::class)->except('show');
        Route::get('/competition/{competition:slug}/registrant', [CompetitionRegistrantController::class, 'index'])->name('competition.registrant');
        Route::get('/competition/{registrant}/member', [CompetitionRegistrantController::class, 'member'])->name('competition.registrant.member');
        Route::get('/competition/{competition:slug}/registrant/export', [CompetitionRegistrantController::class, 'export'])->name('competition.registrant.export');
        Route::delete('/competition/registrant/{registrant}', [CompetitionRegistrantController::class, 'destroy'])->name('competition.registrant.delete');

        Route::resource('/event', EventController::class)->except('show');
        Route::get('/event/{event:slug}/registrant', [EventRegistrantController::class, 'index'])->name('event.registrant');
        Route::get('/event/{event:slug}/registrant/export', [EventRegistrantController::class, 'export'])->name('event.registrant.export');
        Route::delete('/event/registrant/{person}', [EventRegistrantController::class, 'destroy'])->name('event.registrant.delete');

        Route::resource('/sponsor', SponsorController::class)->except('show');
        Route::resource('/committee', CommitteeController::class)->except('show');
        Route::resource('/admin-management', AdminController::class)->except('show')->parameter('admin-management', 'admin');
    });

    Route::group(['prefix' => 'registrant'], function () {
        Route::get('/competition', function () {
            $registers = Registrant::where('user_id', auth()->id())->first();
            return view('registrant.competition.index', compact('registers'));
        })->name('registrant.competition');

        Route::resource('member', MemberController::class)
            ->except('show')
            ->parameter('member', 'id')
            ->names('registrant.member');

        Route::get('/transaction', [TransactionController::class, 'index'])->name('registrant.transaction');
        Route::get('/ticket/{id?}', [TransactionController::class, 'ticket'])->name('registrant.ticket');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::post('/upload-image-from-editor', [BlogController::class, 'uploadImageFromEditor']);

Auth::routes([
    'register' => true,
    'reset' => true,
    'verify' => true,
]);

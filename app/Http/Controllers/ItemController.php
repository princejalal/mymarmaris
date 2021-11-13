<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Currency;
use App\Destination_info;
use App\Destinations;
use App\District;
use App\District_info;
use App\Photo;
use App\Tour;
use App\Tour_info;
use App\Tour_price;
use App\Tour_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ItemController extends MyController {
    
    
    private $lang_id;
    
    public function __construct(Request $request) {
        parent::__construct($request);
        
        $this->lang_id = get_lang_id($request->lng);
        
    }

    public function index($itemName) {

        $tour = Tour_info::where('lang_id', $this->lang_id)->where(DB::raw('BINARY url'),
            $itemName)->first();

        $destination = Destination_info::where('lang_id', $this->lang_id)->where(DB::raw('BINARY url'),
            $itemName)->first();

        if ($tour && !$destination):

            $tourData = $this->tour($tour->tour_id);

            return view('tour.index', $tourData);

        elseif (!$tour && $destination):

            $data = $this->dest($destination->destination_id);

            return view('home.dest', $data);

        else:

            return abort(404);

        endif;
    }


    /**
     * @param $tourName
     * @return array
     */
    protected function tour($tourName) {

        $tour_info = Tour_info::where('tour_id', $tourName)->where('lang_id', $this->lang_id)->first();

        $tour = Tour::where('tour_id', $tour_info->tour_id)->where('publish', 1)->first();

        $tourId = $tour->tour_id;

        return [
            'tourPhoto'      => $photo = Photo::where('tour_id', $tourId)->where('gif', 0)->get(),
            'tourPriceAdult' => Tour_price::where('age_range', 'adult')->where('tour_id', $tourId)->where('currency_id',
                Session::get('currency_id'))->first(),
            'prices'         => Tour_price::where('tour_id', $tourId)->where('price', '>',
                0)->where('tour_price.currency_id', Session::get('currency_id'))->orderBy('age_range',
                'DESC')->groupBy('age_range')->get(),
            'tourProgram'    => Tour_program::where('tour_id', $tourId)->where('lang_id', $this->lang_id)->first(),
            'tourInfo'       => $tour_info,
            'destination'    => Destination_info::where('destination_id', $tour->destination_id)->where('lang_id',
                $this->lang_id)->first(),
            'scrollText'     => $tour_info->scrolling_text,
            'tourCurrency'   => Currency::where('currency_id', Session::get('currency_id'))->first(),
            'TourGif'        => Photo::where('tour_id', $tourId)->where('gif', 1)->first(),
            'tourId'         => $tourId,
            'title'          => $tour_info->title,
            'tour'           => $tour,
            'metaDesc'       => $tour_info->meta_desc,
            'metaTags'       => $tour_info->cloud_tags,
            'itemImage'      => asset('content/images/Tours/'.$tourId.'/'.$photo[0]->photo_path)
        ];


    }

    /**
     * @param $destName
     * @return array
     */
    protected function dest($destName) {

        $destinationInfo = Destination_info::where('lang_id', $this->lang_id)->where('destination_id',
            $destName)->first();

        if ($destinationInfo):
            $dest_id = $destinationInfo->destination_id;

            return [
                'scrollText'      => $destinationInfo->scrolling_text,
                'dest_id'         => $destinationInfo->destination_id,
                'destInfo'        => Destinations::where('destination_id', $dest_id)->first(),
                'tours'           => Tour::select('tour.*', 'tour_photo.photo_path', 'tour_price.price',
                    'tour_price.currency_id', 'tour_info.url', 'tourGif.gif')->where('publish',
                    1)->where('tour_info.lang_id', $this->lang_id)->where('tour_price.age_range',
                    'adult')->where('destination_id', $dest_id)->where('tour_photo.cover', 1)->where('tour.parent_id',
                    '>', 0)->where('lng_id', $this->lang_id)->where('tour_price.currency_id',
                    Session::get('currency_id'))->leftJoin('tour_info', 'tour_info.tour_id', '=',
                    'tour.parent_id')->leftJoin('tour_photo', 'tour_photo.tour_id', '=',
                    'tour.parent_id')->leftJoin(DB::raw('(SELECT photo_id,tour_id,photo_path as gif FROM tour_photo WHERE gif = 1) tourGif'),
                    DB::raw('tourGif.tour_id'), '=', 'tour.parent_id')->leftJoin('tour_price', 'tour_price.tour_id',
                    '=', 'tour.parent_id')->groupBy('tour.tour_id')->get(),
                'destinationInfo' => $destinationInfo,
                'title'           => $destinationInfo->title,
                'metaDesc'        => $destinationInfo->meta_desc,
                'metaTags'        => $destinationInfo->meta_tags
            ];


        endif;

    }


}

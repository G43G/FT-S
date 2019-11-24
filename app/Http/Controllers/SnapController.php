<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Models\SnapImage;
use App\Models\Snap;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;

class SnapController extends Controller {

    public function loadMoreAllHomeSnaps(Request $request) {

        $lastID = $request->get('snapID');

        try {
            $snap = new Snap();

            if ( $request->ajax() ) {

                if ( $lastID > 0 ) {
                    $data = $snap->loadMoreAllHomeSnaps($lastID);
                } else {
                    $data = $snap->getAllHomeSnaps();
                }

                $output = '';
                $lastID = '';

                if ( !$data->isEmpty() ) {

                    foreach( $data as $row ) {
                        $output .= '<div class="6u">
                                    <article class="item">
                                        <a href="' . asset("/snap/" . $row->snapID ) . '" class="image fit">
                                            <img src="' . asset("/") . $row->path . '" alt="snap image" />';

                        if ( $row->filter === 1 ) {
                            $style = 'background-color: transparent;';
                        } else {
                            $style = 'background-color: ' . substr($row->class, 7) . ';';
                        }

                        $output .= '<div class="filter-overlay" style="' . $style . '"></div>
                            </a>
                            <header class="snap-text">
                                <h3>' . substr(strip_tags($row->text), 0, 35) . '</h3>
                            </header>
                            <header class="snap-icons">
                                <div class="snap-like-icon-holder">
                                    <span class="snap-like-button-holder"></span>
                                    <span class="snap-likes-count"></span>
                                </div>
                                <div class="snap-comments-icon-holder">
                                    <span class="icon-comment">
                                        <i class="icon fa-comment"></i>
                                        <span class="snap-comments-count"></span>
                                    </span>
                                </div>
                                <div class="snap-views-icon-holder">
                                    <i class="icon fa-eye"></i>
                                    <span class="snap-views-count"></span>
                                </div>
                                <div class="snap-privacy-icon-holder">';

                        if ( $row->status === "public" ) {
                            $output .= '<span class="icon-privacy"><i class="icon fa-globe"></i></span>';
                        } else {
                            $output .= '<span class="icon-privacy"><i class="icon fa-lock"></i></span>';
                        }

                        $output .= '</div>
                            </header>
                            <input type="hidden" class="hidden-snap-id" value="' . $row->snapID . '" />
                        </article>
                    </div>';

                        $lastID = $row->snapID;
                    }

                    $output .= '<div class="12u load-more-all-home-snaps-form-holder">
                                    <form id="load-more-all-home-snaps-form" method="POST">
                                        <input type="button" id="load-more-all-home-snaps-button" name="load-more-all-home-snaps-button" class="load-more-button" value="Load More" data-id="' . $lastID . '" />
                                    </form>
                                </div>';
                } else {

                    $output .= '<div class="12u"><h3>No More Snaps Found</h3></div>';
                }

                return response($output, 200);
            }
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function loadMorePublicHomeSnaps(Request $request) {

        $lastID = $request->get('id');

        try {
            $snap = new Snap();

            if ( $request->ajax() ) {

                if ( $lastID > 0 ) {
                    $data = $snap->loadMorePublicHomeSnaps($lastID);
                } else {
                    $data = $snap->getPublicHomeSnaps();
                }

                $output = '';
                $lastID = '';

                if ( !$data->isEmpty() ) {

                    foreach( $data as $row ) {
                        $output .= '<div class="6u">
                                    <article class="item">
                                        <a href="' . asset("/snap/" . $row->snapID ) . '" class="image fit">
                                            <img src="' . asset("/") . $row->path . '" alt="snap image" />';

                        if ( $row->filter === 1 ) {
                            $style = 'background-color: transparent;';
                        } else {
                            $style = 'background-color: ' . substr($row->class, 7) . ';';
                        }

                        $output .= '<div class="filter-overlay" style="' . $style . '"></div>
                            </a>
                            <header class="snap-text">
                                <h3>' . substr(strip_tags($row->text), 0, 35) . '</h3>
                            </header>
                            <header class="snap-icons">
                                <div class="snap-like-icon-holder">
                                    <span class="snap-like-button-holder"></span>
                                    <span class="snap-likes-count"></span>
                                </div>
                                <div class="snap-comments-icon-holder">
                                    <span class="icon-comment">
                                        <i class="icon fa-comment"></i>
                                        <span class="snap-comments-count"></span>
                                    </span>
                                </div>
                                <div class="snap-views-icon-holder">
                                    <i class="icon fa-eye"></i>
                                    <span class="snap-views-count"></span>
                                </div>
                                <div class="snap-privacy-icon-holder">';

                        if ( $row->status === "public" ) {
                            $output .= '<span class="icon-privacy"><i class="icon fa-globe"></i></span>';
                        } else {
                            $output .= '<span class="icon-privacy"><i class="icon fa-lock"></i></span>';
                        }

                        $output .= '</div>
                            </header>
                            <input type="hidden" class="hidden-snap-id" value="' . $row->snapID . '" />
                        </article>
                    </div>';

                        $lastID = $row->snapID;
                    }

                    $output .= '<div class="12u load-more-latest-form-holder">
                                <form id="load-more-latest-form" method="POST">
                                    <input type="button" id="loadMoreLatestBtn" name="loadMoreLatestBtn" class="load-more-button" value="Load More" data-id="' . $lastID . '"/>
                                </form>
                            </div>';
                } else {

                    $output .= '<div class="12u"><h3>No More Snaps Found</h3></div>';
                }

                return response($output, 200);
            }
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function addSnap(Request $request) {

        $rules = [
            'snapImgUpload' => 'required|mimes:jpg,jpeg,png',
            'snapText'      => 'max:100',
            'snapStatus'    => 'required'
        ];

        $messages = [
            'snapImgUpload.required' => 'You didn\'t choose an image.',
            'snapImgUpload.mimes'    => 'Allowed picture formats are .jpg, .jpeg and .png.',
            'snapText.max'           => 'Your text is exceeding maximum number of allowed characters.',
            'snapStatus.required'    => 'You didn\'t choose privacy setting.'
        ];

        $request->validate($rules, $messages);

        $image = $request->file('snapImgUpload');
        $name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $tmp_path = $image->getPathName();

        $folder = 'img/snaps/';
        $file_name = $name.'.'.time().'.'.$extension;
        $new_path = public_path($folder).$file_name;

        $thumb_image = Image::make($image->getRealPath());
        $thumb_image->orientate();
        $thumb_image->resize(256, 256);

        $filter = $request->get('snapFilter');
        $text = $request->get('snapText');
        $status = $request->get('snapStatus');
        $user = session()->get('user')[0]->id;


        try {
            File::move($tmp_path, $new_path);
            $thumb_image->save(public_path('img/snaps/thumbs/'.$file_name));

            $snapImage = new SnapImage();
            $snap = new Snap();

            $snapImage->path = 'img/snaps/'.$file_name;
            $snapImage->thumb_path = 'img/snaps/thumbs/'.$file_name;

            $snap->image = $snapImage->addSnap();
            if ( $filter === null ) {
                $snap->filter = 1;
            } else {
                $snap->filter = $filter;
            }
            $snap->text = $text;
            $snap->status = $status;
            $snap->user = $user;
            $snap->addSnap();

            return redirect()->back()->with('success', 'Snap added.');
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function removeSnap($snapID) {

        try {
            $snap = new Snap();
            $image = new SnapImage();

            $like = new Like();
            $comment = new Comment();

            $snapId = $snap->getSnapToDelete($snapID)->id;

            $like->deleteSnapLikes($snapId);
            $comment->deleteSnapComments($snapId);
            $snap->deleteSnapViews($snapId);

            $snap->image = $snapID;
            $snap->removeSnap();

            $image->id = $snapID;
            $image_to_delete = $image->get();
            File::delete($image_to_delete->path);
            File::delete($image_to_delete->thumb_path);
            $image->deleteSnap();

            return redirect()->back()->with('success', 'Snap deleted.');
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function updateSnap($snapID, Request $request) {

        $text = $request->get('text');
        $status = $request->get('status');

        try {
            $snap = new Snap();

            $snap->text = $text;
            $snap->status = $status;

            $snap->updateSnap($snapID);

            return response(200);
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function getViewsCount(Request $request) {

        $snapID = $request->get('id');

        try {
            $snap = new Snap();

            $views = $snap->getViewsCount($snapID);

            return response($views, 200);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function loadMoreArchiveSnaps(Request $request, $archiveDate) {

        $lastID = $request->get('id');

        try {
            $snap = new Snap();

            if ( $request->ajax() ) {

                if ( $lastID > 0 ) {
                    $data = $snap->loadMoreArchiveSnaps($lastID, $archiveDate);
                } else {
                    $data = $snap->getArchiveSnaps($archiveDate);
                }

                $output = '';
                $lastID = '';

                if ( !$data->isEmpty() ) {

                    foreach( $data as $row ) {
                        $output .= '<div class="6u">
                                    <article class="item">
                                        <a href="' . asset("/snap/" . $row->snapID ) . '" class="image fit">
                                            <img src="' . asset("/") . $row->path . '" alt="snap image" />';

                        if ( $row->filter === 1 ) {
                            $style = 'background-color: transparent;';
                        } else {
                            $style = 'background-color: ' . substr($row->class, 7) . ';';
                        }

                        $output .= '<div class="filter-overlay" style="' . $style . '"></div>
                            </a>
                            <header class="snap-text">
                                <h3>' . substr(strip_tags($row->text), 0, 35) . '</h3>
                            </header>
                            <header class="snap-icons">
                                <div class="snap-like-icon-holder">
                                    <span class="snap-like-button-holder"></span>
                                    <span class="snap-likes-count"></span>
                                </div>
                                <div class="snap-comments-icon-holder">
                                    <span class="icon-comment">
                                        <i class="icon fa-comment"></i>
                                        <span class="snap-comments-count"></span>
                                    </span>
                                </div>
                                <div class="snap-views-icon-holder">
                                    <i class="icon fa-eye"></i>
                                    <span class="snap-views-count"></span>
                                </div>
                                <div class="snap-privacy-icon-holder">';

                        if ( $row->status === "public" ) {
                            $output .= '<span class="icon-privacy"><i class="icon fa-globe"></i></span>';
                        } else {
                            $output .= '<span class="icon-privacy"><i class="icon fa-lock"></i></span>';
                        }

                        $output .= '</div>
                            </header>
                            <input type="hidden" class="hidden-snap-id" value="' . $row->snapID . '" />
                        </article>
                    </div>';

                        $lastID = $row->snapID;
                    }

                    $output .= '<div class="12u load-more-archive-snaps-form-holder">
                                    <form id="load-more-archive-snaps-form" method="POST">
                                        <input type="button" id="load-more-archive-snaps-button" name="load-more-archive-snaps-button" class="load-more-button" value="Load More" data-id="' . $lastID . '" />
                                    </form>
                                </div>';
                } else {

                    $output .= '<div class="12u"><h3>No More Snaps Found</h3></div>';
                }

                return response($output, 200);
            }
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return response('Oops, there\'s been an error. Please, try again.', 500);
        }
    }

    public function showSnapData(Request $request) {

        $id = intval($request->get('id'));

        try {

            $snap = new Snap();

            $data = $snap->getSnapData($id);

            $html = '<div>';

            foreach( $data as $i ) {
                $image = $i->image;

                $text = $i->text;

                $html .= '<img alt="snap-image" src="' . asset($image) . '"/><br/>';
                $html .= '<span>' . $text . '</span><br/>';
            }

            $html .= '</div>';

            return response($html, 200);

        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function activateEditSnap(Request $request) {

        $id = intval($request->get('id'));

        try {

            $snap = new Snap();

            $data = $snap->getSnapData($id);

            return response($data, 200);

        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function editSnap(Request $request) {

        $snapID = intval( $request->get('snap-id') );
        $imageID = intval( $request->get('snap-image-id') );

        $user = $request->get('snap-user');
        $filter = $request->get('snap-filter');
        $status = $request->get('snap-status');
        $text = $request->get('snap-text');

        $image = $request->file('snap-image');

        try {

            $snapImage = new SnapImage();
            $snap = new Snap();

            $snap->user = $user;
            $snap->filter = $filter;
            $snap->status = $status;
            $snap->text = $text;

            if ( $image !== null ) {

                $name = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $tmp_path = $image->getPathName();

                $folder = 'img/snaps/';
                $file_name = $name . '.' . time() . '.' . $extension;
                $new_path = public_path( $folder ) . $file_name;

                $thumb_image = Image::make( $image->getRealPath() );
                $thumb_image->orientate();
                $thumb_image->resize( 256, 256 );

                File::move( $tmp_path, $new_path );
                $thumb_image->save( public_path( 'img/snaps/thumbs/' . $file_name ) );

                $snapImage->path = 'img/snaps/' . $file_name;
                $snapImage->thumb_path = 'img/snaps/thumbs/' . $file_name;

                $snapImage->id = $imageID;
                $image_to_delete = $snapImage->get();
                File::delete($image_to_delete->path);
                File::delete($image_to_delete->thumb_path);

                $snapImage->updateSnap($imageID);

                $snap->updateSnapInfo($snapID);
            } else {
                $snap->updateSnapInfo($snapID);
            }

            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function insertSnap(Request $request) {

        $image = $request->file('snap-image');

        $name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $tmp_path = $image->getPathName();

        $folder = 'img/snaps/';
        $file_name = $name . '.' . time() . '.' . $extension;
        $new_path = public_path( $folder ) . $file_name;

        $thumb_image = Image::make( $image->getRealPath() );
        $thumb_image->orientate();
        $thumb_image->resize( 256, 256 );

        $user = $request->get('snap-user');
        $filter = $request->get('snap-filter');
        $status = $request->get('snap-status');
        $text = $request->get('snap-text');

        try {
            File::move( $tmp_path, $new_path );
            $thumb_image->save( public_path( 'img/snaps/thumbs/' . $file_name ) );

            $snapImage = new SnapImage();
            $snap = new Snap();

            $snapImage->path = 'img/snaps/' . $file_name;
            $snapImage->thumb_path = 'img/snaps/thumbs/' . $file_name;

            $snap->image = $snapImage->addSnap();

            $snap->user = $user;
            $snap->filter = $filter;
            $snap->status = $status;
            $snap->text = $text;

            $snap->addSnap();

            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function deleteSnap($snapID) {

        try {
            $snap = new Snap();
            $image = new SnapImage();

            $like = new Like();
            $comment = new Comment();

            $imageID = $snap->getImageToDelete($snapID)->image;

            $like->deleteSnapLikes($snapID);
            $comment->deleteSnapComments($snapID);
            $snap->deleteSnapViews($snapID);

            $snap->id = $snapID;
            $snap->deleteSnap();

            $image->id = $imageID;
            $image_to_delete = $image->get();
            File::delete($image_to_delete->path);
            File::delete($image_to_delete->thumb_path);
            $image->deleteSnap();

            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }

    public function redirect(Request $request) {

        $snapID = $request->get('snapID');

        try {
            $snap = new Snap();

            $snap->deleteView($snapID);

            return response(200);
        }
        catch(\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'Oops, there\'s been an error. Please, try again.');
        }
    }
}

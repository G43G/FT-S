<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Navigation;
use App\Models\Comment;
use App\Models\Thread;
use App\Models\Filter;
use App\Models\User;
use App\Models\Snap;
use App\Models\Like;
use App\Models\Role;

class FrontEndController extends Controller {
    private $data = [];

    public function __construct() {
        $navigation = new Navigation();

        $this->data['navAdmins'] = $navigation->getNavAdmin();
        $this->data['navUsers'] = $navigation->getNavUser();
        $this->data['navs'] = $navigation->getNav();
    }

    public function getHome() {

        try {
            $snap = new Snap();

            $this->data['allHomeSnaps'] = $snap->getAllHomeSnaps();
            $this->data['publicHomeSnaps'] = $snap->getPublicHomeSnaps();

            return view('pages.home', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getDiscover() {

        try {
            $user = new User();
            $snap = new Snap();

            $this->data['recentUsers'] = $user->getRecentUsers();
            $this->data['mostLikedSnaps'] = $snap->getMostLikedSnaps();
            $this->data['mostCommentedSnaps'] = $snap->getMostCommentedSnaps();
            $this->data['mostViewedSnaps'] = $snap->getMostViewedSnaps();

            return view('pages.discover', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getResults(Request $request) {

        try {
            $keyword = $request->get('search-keyword');

            $user = new User();
            $snap = new Snap();

            $this->data['userResults'] = $user->getSearchUsers($keyword);

            if(session()->has('user')) {
                $this->data['snapResults'] = $snap->getSearchAuthSnaps($keyword);
            } else {
                $this->data['snapResults'] = $snap->getSearchSnaps($keyword);
            }

            return view('pages.search', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getAuth() {

        try {
            return view('pages.auth', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getProfile() {

        try {
            $user = new User();
            $snap = new Snap();
            $filter = new Filter();
            $comment = new Comment();

            if(session()->has('user')) {
                $userID = session()->get('user')[0]->id;
                $username = session()->get('user')[0]->username;

                $this->data['loggedUser'] = $user->getLoggedUser($userID);
                $this->data['mySnapsCount'] = $snap->getMySnapsCount($userID);
                $this->data['myCommentsCount'] = $comment->getMyCommentsCount($userID);
                $this->data['snapFilters'] = $filter->getAll();
                $this->data['mySnaps'] = $snap->getMySnaps($userID);
                $this->data['myThreads'] = Thread::where('thread_to', $username)
                    ->orWhere('thread_from', $username)
                    ->with('messages')
                    ->get();

                return view('pages.profile', $this->data);
            }
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getSnap(Request $request, $snapID) {

        try {
            $snap = new Snap();
            $like = new Like();
            $comment = new Comment();

            $snap->increaseView($snapID, $request->ip());

            if(session()->has('user')) {
                $userID = session()->get('user')[0]->id;

                $this->data['singleSnap'] = $snap->getSingleSnap($snapID);
                $this->data['snapUserLikes'] = $like->getLikes($snapID, $userID);
            } else {
                $this->data['singleSnap'] = $snap->getPublicSnap($snapID);
            }

            $this->data['snapLikesCount'] = $like->getLikesCount($snapID);
            $this->data['snapComments'] = $comment->getComments($snapID);
            $this->data['snapCommentsCount'] = $comment->getCommentsCount($snapID);

            return view('pages.snap', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getAbout() {

        try {
            return view('pages.about', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function download() {
        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download(public_path('documentation.pdf'), 'documentation.pdf', $headers);
    }

    public function getAdminUsers() {

        try {
            $user = new User();
            $role = new Role();

            $this->data['adminUsers'] = $user->getAdminUsers();
            $this->data['roles'] = $role->getRoles();

            return view('admin.users', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getAdminRoles() {

        try {
            $role = new Role();

            $this->data['adminRoles'] = $role->getRoles();

            return view('admin.roles', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getAdminSnaps() {

        try {
            $snap = new Snap();
            $filter = new Filter();
            $user = new User();

            $this->data['adminSnaps'] = $snap->getSnaps();
            $this->data['filters'] = $filter->getFilters();
            $this->data['users'] = $user->getAdminUsers();

            return view('admin.snaps', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getAdminFilters() {

        try {
            $filter = new Filter();

            $this->data['adminFilters'] = $filter->getFilters();

            return view('admin.filters', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getAdminComments() {

        try {
            $comment = new Comment();

            $this->data['adminComments'] = $comment->getAdminComments();

            return view('admin.comments', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getUser($username) {

        try {
            $user = new User();
            $snap = new Snap();
            $comment = new Comment();

            $this->data['requestedUser'] = $user->getRequestedUser($username);
            $this->data['userSnapsCount'] = $snap->getUserSnapsCount($username);
            $this->data['userCommentsCount'] = $comment->getUserCommentsCount($username);

            if(session()->has('user')) {
                $this->data['userSnaps'] = $snap->getAllUserSnaps($username);
            } else {
                $this->data['userSnaps'] = $snap->getPublicUserSnaps($username);
            }

            return view('pages.user', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }

    public function getArchive($archiveDate) {

        try {
            $snap = new Snap();

            $this->data['archiveSnaps'] = $snap->getArchiveSnaps($archiveDate);

            return view('pages.archive', $this->data);
        }
        catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
}

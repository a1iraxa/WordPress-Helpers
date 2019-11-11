if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function ($) {

    // Select with ajax
    window.initSelect2getAjaxContent = function(element_class_name, route_url){
        $(element_class_name).select2({
            ajax: {
                url: laroute.route(route_url),
                dataType: 'json',
                delay : 200,
                data : function(params){
                    return {
                        q: $.trim(params.term),
                        page : params.page
                    };
                },
                processResults : function(data){
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength : 3,
        });
    }

    // In Popup (Bootstrap Model)
    window.initSelect2getAjaxContentInPopup = function(element_class_name, url, popup_id){
        $(element_class_name).select2({
            dropdownParent: $(`#${popup_id}`),
            ajax: {
                url: laroute.route(url),
                dataType: 'json',
                delay : 200,
                data : function(params){
                    return {
                        q: $.trim(params.term),
                        page : params.page
                    };
                },
                processResults : function(data){
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength : 3,
        });
    }
    // Usage:
    // window.initSelect2getAjaxContentInPopup( 'element_class/ID', 'shared.doctor.roster.select2.doctor', 'rosteringModel');

    /*
        Server Side in Larvel
        public function getSelect2Content(Request $request){

            $term = trim($request->q);

            if (empty($term)) {
                return Response::json([]);
            }

            $users = User::whereHas('roles', function($q) {
                $q->where('name', 'doctor');
            })
            ->where('name', 'like', '%' . $term . '%')
            ->orderBy('name', 'ASC')
            ->get();

            $formatted_users = [];

            foreach ($users as $user) {
                $formatted_users[] = ['id' => $user->id, 'text' => $user->name];
            }

            return Response::json($formatted_users);
        }
    */

});

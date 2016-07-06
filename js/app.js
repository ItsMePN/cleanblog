
var __env;

/* Import variables if present */
if(window){
    Object.assign(__env, window.__env);
}

var app = angular.module('pnApp', ['ngRoute', 'ngSanitize', 'angularUtils.directives.dirDisqus']);


/* Register environment in AngularJS as constant */
app.constant('__env', __env);

app.config( function( $routeProvider, $locationProvider ) {
	$locationProvider.html5Mode( true );

    $routeProvider
    .when( '/', {
        title: 'home',
        templateUrl: pnLocalized.parts + 'content.html',
        controller: 'content'
    });

    /* route to single article page */
	$routeProvider
	.when( '/:slug', {
        title: 'post',
		templateUrl: pnLocalized.parts + 'content-single.html',
		controller: 'content-single'
	});

    /* route to standard page */

    $routeProvider
    .when( '/pages/:slug', {
        title: 'page',
        templateUrl: pnLocalized.parts + 'content-page.html',
        controller: 'content-page'
    });

    /* route to category archive page */
    $routeProvider
    .when( '/category/:category', {
        title: 'Category',
        templateUrl: pnLocalized.parts + 'archive.html',
        controller: 'archive'
    });

    /* route to tag archive page */
    $routeProvider
    .when( '/tag/:tag', {
        title: 'Tag',
        templateUrl: pnLocalized.parts + 'archive.html',
        controller: 'archive'
    });

    /* route to category archive pagination */
    $routeProvider
    .when('/category/:category/page/:page', {
        title: 'Cat Paged',
        templateUrl: pnLocalized.parts + 'archive.html',
        controller: 'archive'
    });

    /* route to tag archive pagination */
    $routeProvider
    .when('/tag/:tag/page/:page', {
        title: 'Tag Paged',
        templateUrl: pnLocalized.parts + 'archive.html',
        controller: 'archive'
    });

    /* route to posts pagination */
    $routeProvider
    .when('/page/:page', {
        title: 'Post Paged',
        templateUrl: pnLocalized.parts + 'content.html',
        controller: 'Paged'
    });


    //$routeProvider
    //.when( '/?s=', {
    //        templateUrl: pnLocalized.parts + 'content-search.html',
    //        controller: 'content-search'
    //});

    $routeProvider
    .otherwise({
        redirectTo: '/'
    });

});

app.controller( 'content', function( $scope, $rootScope, $http, __env ) {

    $scope.loaded = false;
    $scope.header_image = window.__env.defaultHeaderImg;

	$http({
	  method: 'GET',
	  url: __env.apiUrl + 'posts?filter[posts_per_page]=5'
	}).then(function successCallback(response) {
        // when the response is available
        $scope.posts = response.data;
        $scope.pageTitle = window.__env.siteTitle;
        $scope.pageDesc = window.__env.siteDescription;
        $scope.loaded = true;
        document.querySelector('title').innerHTML = $scope.pageTitle + ' | ' + $scope.pageDesc;// this callback will be called asynchronously
        $scope.currentPage = 1;
        $scope.totalPages = response.headers('X-WP-TotalPages');

    }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
        console.log("Something went wrong" + response.data.posts);

    });

});

app.controller('archive', function($scope, $http, $route, $routeParams, __env  ) {

    $scope.loaded = false;
    $scope.header_image = window.__env.defaultHeaderImg;

    var getUrl,
        paged = '';

    paged = typeof $routeParams.page === 'undefined' ? '&page=1' : '&page=' + $routeParams.page;

    if ( 'Category' === $route.current.$$route.title || 'Cat Paged' === $route.current.$$route.title) {
        getUrl = 'posts/?filter[posts_per_page]=5&filter[category_name]=' + $routeParams.category + paged
        $scope.pageTitle = 'Category';
        $scope.pageDesc = $routeParams.category;
    }
    if ( 'Tag' === $route.current.$$route.title || 'Tag Paged' === $route.current.$$route.title) {
        getUrl = 'posts/?filter[posts_per_page]=5&filter[tag]=' + $routeParams.tag + paged
        $scope.pageTitle = 'Tag';
        $scope.pageDesc = $routeParams.tag;
    }

    console.log( getUrl );

	$http({
	  method: 'GET',
	  url: __env.apiUrl + getUrl
	}).then(function successCallback(response) {
        // when the response is available
        $scope.posts = response.data;
        $scope.loaded = true;

        if( typeof $routeParams.page === 'undefined')
            $scope.currentPage = 1;
        else
            $scope.currentPage = $routeParams.page;

        $scope.totalPages = response.headers('X-WP-TotalPages');

        document.querySelector('title').innerHTML = $scope.pageTitle + ' | ' + $scope.pageDesc;	// this callback will be called asynchronously

    }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
        console.log("Something went wrong" + response.data.posts);

	  });

});


/* single article controller */

app.controller('content-single', function( $scope, $http, $routeParams, __env  ) {

    $scope.loaded = false;

	$http({
	  method: 'GET',
	  url: __env.apiUrl + 'posts?filter[name]=' + $routeParams.slug
	}).then(function successCallback(response) {
        // this callback will be called asynchronously
        // when the response is available
        $scope.post = response.data[0];
        console.log(response.data[0]);
        console.log ($scope.post.id);
        console.log ($scope.post.link);

        if ( $scope.post.featured_image_url == null )
            $scope.header_image = window.__env.defaultHeaderImg;
        else
            $scope.header_image = $scope.post.featured_image_url;

        $scope.pageTitle = response.data[0].title.rendered;
        $scope.pageDesc = window.__env.siteTitle;

        $scope.disqusConfig = {
            disqus_shortname: 'prasadnevase',
            disqus_identifier: $scope.post.id,
            disqus_url: $scope.post.link
        };

        $scope.loaded = true;
        document.querySelector('title').innerHTML = $scope.pageTitle + ' - ' + $scope.pageDesc;

	  }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
        console.log("Something went wrong:" + response);
	  });

});

/* single page controller */

app.controller('content-page', function( $scope, $http, $routeParams, __env ) {

    $scope.loaded = false;

    $http({
        method: 'GET',
        url: __env.apiUrl + 'pages?filter[name]=' + $routeParams.slug
    }).then(function successCallback(response) {
        $scope.post = response.data[0];
        $scope.loaded = true;

        if ( $scope.post.featured_image_url == null )
            $scope.header_image = window.__env.defaultHeaderImg;
        else
            $scope.header_image = $scope.post.featured_image_url;

        $scope.pageTitle = response.data[0].title.rendered;
        $scope.pageDesc = window.__env.siteTitle;

        document.querySelector('title').innerHTML = $scope.pageTitle + ' - ' + $scope.pageDesc;
        //console.log($scope.post);
        // this callback will be called asynchronously
        // when the response is available
    }, function errorCallback(response) {
        console.log("Something went wrong:" + response);
        // called asynchronously if an error occurs
        // or server returns response with an error status.
    });

});


//Paged controller
app.controller('Paged', function( $scope, $routeParams, $http, __env ) {

    $scope.loaded = false;
    $scope.header_image = window.__env.defaultHeaderImg;

    $http({
        method: 'GET',
        url: __env.apiUrl + 'posts?filter[posts_per_page]=5&page=' + $routeParams.page
    }).then(function successCallback(response, status, headers){

        var currentPage = parseInt($routeParams.page);
        $scope.currentPage = currentPage;
        $scope.totalPages = response.headers('X-WP-TotalPages');

        $scope.posts = response.data;

        $scope.loaded = true;

        $scope.pageTitle = 'Posts on Page ' + $scope.currentPage;
        document.querySelector('title').innerHTML = $scope.pageTitle;

    }, function errorCallback(response) {
        console.log("Something went wrong:" + response);
        // called asynchronously if an error occurs
        // or server returns response with an error status.
    });
});

/* Custom directive for search form */

app.directive('searchForm', function() {
    return {
        restrict: 'EA',
        template: 'Search Keyword: <input type="text" name="s" ng-model="filter.s" ng-change="search()">',
        controller: ( 'content-search', ['$scope','$routeParams', function( $scope, $http, $routeParams ){
            $scope.filter = {
                s: ''
            };
            $scope.search = function() {
                if ( $scope.filter.s.length >= 5 ) {
                    console.log( $routeParams.s );
                    $http({
                        method: 'GET',
                        url: 'http://localhost/ifeature/wp-json/wp/v2/posts?filter[s]=' + $routeParams.param1
                    }).then(function successCallback(response) {
                        console.log( response.data );
                        $scope.posts = response.data;
                        // this callback will be called asynchronously
                        // when the response is available
                    }, function errorCallback(response) {
                        console.log("Something went wrong" + response);
                        // called asynchronously if an error occurs
                        // or server returns response with an error status.
                    });
                }
            }
        }])
    };
});

/* Directive for header */

app.directive( 'cleanblogHeader', function () {
    return {
        restrict: 'EA', //E = element, A = attribute, C = class, M = comment
        scope: true,
        templateUrl: pnLocalized.parts + 'dir-cleanblog-header.html',
        controller: function ( $scope ) {
            //console.log( $scope.post.title.rendered );

        }
        //link: function ($scope, element, attrs) { } //DOM manipulation
    }
});


/* Directive for post-meta */

app.directive( 'postMeta', function () {
    return {
        restrict: 'EA', //E = element, A = attribute, C = class, M = comment
        scope: true,
        templateUrl: pnLocalized.parts + 'dir-post-meta.html',
        controller: function ( $scope ) {
            //console.log(  );

        }
        //link: function ($scope, element, attrs) { } //DOM manipulation
    }
});

/* Directive for post-social-buttons */

app.directive( 'postSocial', function () {
    return {
        restrict: 'EA', //E = element, A = attribute, C = class, M = comment
        scope: true,
        templateUrl: pnLocalized.parts + 'dir-post-social.html',
        controller: function ( $scope ) {
            //console.log(  );

        }
        //link: function ($scope, element, attrs) { } //DOM manipulation
    }
});

/* Directive for post-comments */

app.directive( 'postComments', function () {
    return {
        restrict: 'EA', //E = element, A = attribute, C = class, M = comment
        scope: true,
        templateUrl: pnLocalized.parts + 'dir-post-comments.html',
        controller: function ( $scope ) {
            //console.log(  );

        }
        //link: function ($scope, element, attrs) { } //DOM manipulation
    }
});

app.directive( 'fadeIn', function($timeout){
    return {
        restrict: 'A',
        link: function($scope, $element, attrs){
            $element.addClass("ng-hide-remove");
            $element.on('load', function() {
                $element.addClass("ng-hide-add");
            });
        }
    };
});

/* postsNavLink Directive */
app.directive( 'postsNavLink', function() {
    return {
        restrict: 'EA',
        templateUrl: pnLocalized.parts + 'dir-posts-nav-link.html',
        controller: ['$scope', '$element', '$rootScope', '$routeParams', function( $scope, $element, $rootScope, $routeParams ){

            var currentPage = ( ! $routeParams.page ) ? 1 : parseInt( $routeParams.page ),
                linkPrefix = ( ! $routeParams.category ) ? 'page/' : 'category/' + $routeParams.category + '/page/';
                linkPrefix = ( ! $routeParams.tag ) ? 'page/' : 'tag/' + $routeParams.tag + '/page/';

            $scope.postsNavLink = {
                prevLink: linkPrefix + ( currentPage - 1 ),
                nextLink: linkPrefix + ( currentPage + 1 ),
                sep: ( ! $element.attr('sep') ) ? '|' : $element.attr('sep'),
                prevLabel: ( ! $element.attr('prev-label') ) ? 'Previous Page' : $element.attr('prev-label'),
                nextLabel: ( ! $element.attr('next-label') ) ? 'Next Page' : $element.attr('next-label')
            };
        }]
    };
});


app.filter('isEmpty', function () {
        var bar;
        return function (obj) {
            for (bar in obj) {
                if (obj.hasOwnProperty(bar)) {
                    return false;
                }
            }
            return true;
        };
});


// https://docs.angularjs.org/guide/bootstrap
//
//    angular.element(document).ready(function() {
//    angular.bootstrap(document, ['myApp']);
//});

class ApiUtil{

  static const String MAIN_API_URL="http://10.0.2.2:3000/api";

  static const String ALL_CATEGORIES="/categories/";

  static const String ALL_TAGS="/tags";

  static const String ALL_AUTHORS="/authors";

  static const String ALL_POSTS="/posts";

  static const String SINGLE_POST="/post/";

  static String CATEGORY_POSTS(String categoryID){
    return MAIN_API_URL+ALL_CATEGORIES+categoryID+ALL_POSTS;
  }

  static String POST_DETAILS(String postID){
    return MAIN_API_URL+SINGLE_POST+postID;
  }

}
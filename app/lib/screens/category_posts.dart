import 'package:flutter/material.dart';
import 'package:news_app_mobile/api/categories_api.dart';
import 'package:news_app_mobile/models/post.dart';

class CategoryPosts extends StatefulWidget {

  final String categoryID;

  CategoryPosts(this.categoryID);

  @override
  _CategoryPostsState createState() => _CategoryPostsState();
}

class _CategoryPostsState extends State<CategoryPosts> {

  CategoriesApi categoriesApi = CategoriesApi();

  @override
  Widget build(BuildContext context) {

    // This method is rerun every time setState is called, for instance as done
    // by the _incrementCounter method above.
    //
    // The Flutter framework has been optimized to make rerunning build methods
    // fast, so that you can just rebuild anything that needs updating rather
    // than having to individually change instances of widgets.
    return Scaffold(
      appBar: AppBar(
        // Here we take the value from the HomeScreen object that was created by
        // the App.build method, and use it to set our appbar title.
        title: Text('News App'),

      ),
      body: Container(
        padding: EdgeInsets.all(24),
        child: FutureBuilder(
          future: categoriesApi.fetchPostsForCategory(widget.categoryID),
          builder: (BuildContext context,AsyncSnapshot<List<Post>> asyncSnapshot){
            switch(asyncSnapshot.connectionState){
              case ConnectionState.active:
              //STILL WORKING
                return _loading();

                break;
              case ConnectionState.waiting:
              //STILL WAITING

                return _loading();

                break;
              case ConnectionState.none:
              //ERROR
                return _error('No connection has been made');
                break;
              case ConnectionState.done:
              //COMPLETED

                if(asyncSnapshot.hasError){
                  return _error(asyncSnapshot.error.toString());
                }

                if(asyncSnapshot.hasData){
                  return _drawPostsList(asyncSnapshot.data);
                }

                break;

            }
            return Container();
          },
        ),
      ),
    );


  }

  Widget _drawPostsList(List<Post> posts){
      return Padding(
          padding: const EdgeInsets.all(8.0),
          child: ListView.builder(
            itemCount: posts.length,
            itemBuilder: (BuildContext context,int position){
              return InkWell(
                child: Card(
                  child:Container(
                      padding: const EdgeInsets.all(16),
                      child: Text(posts[position].post_title),


                  ),
                ),

                onTap:(){

                },
              );
            },
          ),
      );

  }

  Widget _error(String error){
    return Container(
      child: Center(
        child: Text(error, style: TextStyle(color: Colors.red),),
      ),

    );
  }

  Widget _loading(){
    return Container(
      child: Center(
        child: CircularProgressIndicator(),
      ),
        //#githubpassword#
    );
  }
}
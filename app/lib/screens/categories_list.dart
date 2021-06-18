import 'package:flutter/material.dart';
import "package:hex/hex.dart";
import '../api/categories_api.dart';
import 'package:news_app_mobile/models/category.dart';
import 'package:news_app_mobile/screens/category_posts.dart';

class Categories extends StatefulWidget {

  @override
  _CategoriesState createState() => _CategoriesState();
}

class _CategoriesState extends State<Categories> {

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
                  title: Text('Categories'),

              ),

              body: Container(
                  padding: EdgeInsets.all(24),
                  child: FutureBuilder(
                      future: categoriesApi.fetchAllCategories(),
                      builder: (BuildContext context,AsyncSnapshot<List<Category>> asyncSnapshot){
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
                                      return _drawCategoriesList(asyncSnapshot.data,context);
                                  }

                                break;
                          }
                          return Container();
                      },
                  ),
              ),
          );
      }


      Widget _drawCategoriesList(List<Category> categories,BuildContext context){
      return ListView.builder(
        itemCount: categories.length,
        itemBuilder: (BuildContext context,int position){
          String hexColor=categories[position].color.replaceAll('#', '0xFF');
          return Card(
              child: Stack(
                  children: <Widget>[
                      Align(
                      alignment: Alignment.bottomCenter,
                        child: SizedBox(
                          height: 2,
                          child: Container(
                            color: Color(int.parse(hexColor)),
                          ),
                        ),
                      ),
                      InkWell(

                          onTap:(){

                            Navigator.push(context, MaterialPageRoute(builder: (context) => CategoryPosts(categories[position].id)));

                          },
                          child:Padding(

                              padding: const EdgeInsets.all(16),

                              child: Text(categories[position].category,style: TextStyle(fontSize: 22))
                          ),
                    ),

                  ],
              ),

          );
        },
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

      );
    }


}

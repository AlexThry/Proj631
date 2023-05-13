package Java;

import java.sql.*;
import java.util.ArrayList;

public class ConnectionDatabase {

    public ConnectionDatabase() {
    }

    public Connection connect() {
        try {
            //étape 1: charger la classe de driver
            Class.forName("com.mysql.jdbc.Driver");
            //étape 2: créer l'objet de connexion
            Connection conn = DriverManager.getConnection(
                    "jdbc:mysql://localhost:3306/proj631?characterEncoding=utf8", "root", "");
            return conn;
            //renvoie une erreur en cas d'erreur au niveau du script SQL
        } catch (SQLException ex) {
            System.out.println("SQLException: " + ex.getMessage());
            //renvoie une erreur si la librairie jdbc n'est pas installée
        } catch (ClassNotFoundException ex) {
            System.out.println("ClassNotFoundException: " + ex.getMessage());
        }
        return null;
    }

    //fonction qui permet d'insérer des lignes dans une base de données SQL
    public void insert(String query, Connection conn){
        try {
            //étape 3: créer l'objet statement
            Statement stmt = conn.createStatement();
            stmt.executeUpdate(query);
            System.out.println("la requète "+query+" est valide");
        }catch (Exception e){
            System.out.println(e);
        }
    }
    //fonction qui permet de renvoyer des données contenues dans une colonne de la base de données
    public ArrayList<String> selectList(String query, Connection conn, String colonne){
        ArrayList<String> tab= new ArrayList<String>();
        // créer l'objet statement
        try{
            Statement stmt = conn.createStatement();
            ResultSet res = stmt.executeQuery(query);
            int i =0;
            while(res.next()){
                //Récupérer par nom de colonne
                tab.add(res.getString(colonne));
                i+=1;
            }
        }catch (Exception e){
            System.out.println(e);
        }
        return tab;

    }
    //fonction qui permet de renvoyer des données contenues dans trois colonnes de la base de données
    public ArrayList<String[]> selectList3(String query, Connection conn, String colonne1, String colonne2, String colonne3){
        ArrayList<String[]> tab= new ArrayList<String[]>();
        // créer l'objet statement
        try{
            Statement stmt = conn.createStatement();
            ResultSet res = stmt.executeQuery(query);
            int i =0;
            while(res.next()){
                //Récupérer par nom de colonne
                tab.add(new String[]{res.getString(colonne1), res.getString(colonne2), res.getString(colonne3)});
                i+=1;
            }
        }catch (Exception e){
            System.out.println(e);
        }
        return tab;
    }
    //fonction qui  permet de supprimer une ligne d'une base de données
    public void delete(String query, Connection conn){
        try{
        Statement stmt = conn.createStatement();
        stmt.executeUpdate(query);
        System.out.println("Suppression...");}
        catch (Exception e){
            System.out.println(e);
        }
    }
    //fonction qui permet de se déconnecter de la base de données
    public void closeConnect(Connection conn){
        try{
            //étape 5: fermez l'objet de connexion
            conn.close();
        }catch (Exception e){
            System.out.println(e);
        }
    }



}


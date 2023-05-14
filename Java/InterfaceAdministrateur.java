package Java;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.ArrayList;

public class InterfaceAdministrateur {
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            try {
                createAndShowGUI();
            } catch (Exception e) {
                e.printStackTrace();
            }
        });
    }

    private static void createAndShowGUI() {
        // on se connecte à la base de données
        ConnectionDatabase connectionDatabase = new ConnectionDatabase();
        Connection connect = connectionDatabase.connect();

        //création de la fenêtre de l'interface
        JFrame frame = new JFrame("Interface Administrateur");
        frame.setDefaultCloseOperation(JFrame.DO_NOTHING_ON_CLOSE);
        frame.setSize(1200, 700);

        frame.addWindowListener(new WindowAdapter() {
            public void windowClosing(WindowEvent e) {
                try {
                    connect.close();
                } catch (SQLException ex) {
                    throw new RuntimeException(ex);
                }finally {
                    frame.dispose();
                }

            }
        });


        //création du conteneur principal
        Container contentPane = frame.getContentPane();

        //création d'un panneau contenant des onglets
        JTabbedPane tabbedPane = new JTabbedPane();
        contentPane.add(tabbedPane, BorderLayout.CENTER);

        //création d'un bouton pour mettre à jour la base de données
        JButton updateDb = new JButton("Update DB");
        contentPane.add(updateDb,BorderLayout.NORTH);

        //l'ActionListener qui actualise la base de données en appuyant sur le bouton
        updateDb.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                createAndShowGUI();
                frame.dispose();
            }
        });

        // Panel pour gérer les genres et les livres
        JPanel booksAndGenresPanel = new JPanel();
        booksAndGenresPanel.setLayout(new BoxLayout(booksAndGenresPanel, BoxLayout.PAGE_AXIS));
        tabbedPane.addTab("Genres et Livres", booksAndGenresPanel);

        // Panel pour ajouter et supprimer un genre
        JPanel genrePanel = new JPanel();
        booksAndGenresPanel.add(genrePanel,BorderLayout.NORTH);

        //création d'un champ de texte qui renseignera sur les résultats de nos commande SQL
        JTextArea textArea = new JTextArea(10, 50);
        textArea.setEditable(false);

        //création d'un texte, d'un champ de texte et d'un bouton pour ajouter un genre
        JLabel genreLabel = new JLabel("Ajouter un genre:");
        genrePanel.add(genreLabel);

        JTextField genreTextField = new JTextField(15);
        genrePanel.add(genreTextField);

        JButton addGenreButton = new JButton("Ajouter genre");
        genrePanel.add(addGenreButton);

        //création d'un bouton et d'une boite qui permet de supprimer des genres de la base de données
        JLabel genreListLabel = new JLabel("Sélectionnez un genre:");
        genrePanel.add(genreListLabel);

        ArrayList<String> genres = connectionDatabase.selectList("SELECT label FROM genre;",connect,"label");
        JComboBox genreComboBox = new JComboBox();
        for(String mot:genres) {
            genreComboBox.addItem(mot);
        }
        genrePanel.add(genreComboBox);

        JButton removeGenreButton = new JButton("Supprimer genre");
        genrePanel.add(removeGenreButton);

        //L'actionListener qui permet d'ajouter un genre quand on appuie sur le bouton
        addGenreButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String genre = genreTextField.getText();
                if (!genre.isEmpty()) {
                    String sql = "INSERT INTO genre (label) " +
                            "VALUES ('"+genre+"');";
                    connectionDatabase.insert(sql,connect);
                    textArea.append("Genre ajouté: " + genre + "\n");
                    genreTextField.setText("");
                    ArrayList<String> genres = connectionDatabase.selectList("SELECT label FROM genre;",connect,"label");
                    genreComboBox.removeAllItems();
                    for(String mot:genres) {
                        genreComboBox.addItem(mot);
                    }
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer un genre valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        //L'actionListener qui permet de supprimer un genre quand on appuie sur le bouton
        removeGenreButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String selectedGenre = (String) genreComboBox.getSelectedItem();
                if (selectedGenre != null) {
                    // Supprimez le genre sélectionné de vos données et mettez à jour le menu déroulant des genres
                    connectionDatabase.delete("DELETE FROM genre WHERE label = '"+selectedGenre+"';",connect);
                    textArea.append("Genre supprimé: " + selectedGenre + "\n");
                    ArrayList<String> genres = connectionDatabase.selectList("SELECT label FROM genre;",connect,"label");
                    genreComboBox.removeAllItems();
                    for(String mot:genres) {
                        genreComboBox.addItem(mot);
                    }
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez sélectionner un genre valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        // Panel pour ajouter un livre, cela comprend toutes les zones de texte et boite de selection ainsi que le boutton
        JPanel bookPanel = new JPanel();
        booksAndGenresPanel.add(bookPanel,BorderLayout.SOUTH);

        JLabel bookLabel = new JLabel("Titre:");
        bookPanel.add(bookLabel);

        JTextField bookTextField = new JTextField(15);
        bookPanel.add(bookTextField);

        JLabel authorLabel = new JLabel("Auteur:");
        bookPanel.add(authorLabel);

        JTextField authorTextField = new JTextField(15);
        bookPanel.add(authorTextField);

        JLabel bookGenreLabel = new JLabel("Genre:");
        bookPanel.add(bookGenreLabel);

        JComboBox bookGenreComboBox = new JComboBox();
        for(String mot:genres) {
            bookGenreComboBox.addItem(mot);
        }
        bookPanel.add(bookGenreComboBox);

        JLabel publicationDateLabel = new JLabel("Date de parution (AAAA/MM/JJ):");
        bookPanel.add(publicationDateLabel);

        JTextField publicationDateTextField = new JTextField(15);
        bookPanel.add(publicationDateTextField);


        JLabel bookDescLabel = new JLabel("Description :");
        bookPanel.add(bookDescLabel);

        JTextField bookDescField = new JTextField(15);
        bookPanel.add(bookDescField);

        JLabel bookUrlLabel = new JLabel("Image Url :");
        bookPanel.add(bookUrlLabel);
        JTextField bookUrlField = new JTextField(15);
        bookPanel.add(bookUrlField);

        JButton addBookButton = new JButton("Ajouter livre");
        bookPanel.add(addBookButton);


        // Suppression de livre, contenant le selecteur ainsi que le bouton de supression
        JPanel bookDeletePanel = new JPanel();

        JLabel bookListLabel = new JLabel("Sélectionnez un livre:");
        ArrayList<String> livres = connectionDatabase.selectList("SELECT title FROM book;",connect,"title");
        JComboBox bookListComboBox = new JComboBox();
        for(String mot:livres) {
            bookListComboBox.addItem(mot);
        }
        bookDeletePanel.add(bookListLabel);

        bookDeletePanel.add(bookListComboBox);

        JButton removeBookButton = new JButton("Supprimer livre");
        bookDeletePanel.add(removeBookButton);

        booksAndGenresPanel.add(bookDeletePanel,BorderLayout.CENTER);

        //action qui se réalise quand on appuie sur le bouton, grâce à des commande SQL, on peut mettre à jour différentes bases de données quand on ajoute un livre
        addBookButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String book = bookTextField.getText();
                String author = authorTextField.getText();
                String genre = (String) bookGenreComboBox.getSelectedItem();
                String publicationDate = publicationDateTextField.getText();
                String description = bookDescField.getText();
                String imageUrl = bookUrlField.getText();
                if (!book.isEmpty() && !author.isEmpty()  && !publicationDate.isEmpty() && !description.isEmpty() && !imageUrl.isEmpty()) {
                    textArea.append("Livre ajouté: " + book + " | Auteur: " + author + " | Genre: " + genre + " | Date de parution: " + publicationDate + "\n");
                    bookTextField.setText("");
                    authorTextField.setText("");
                    bookGenreComboBox.setSelectedIndex(0);
                    publicationDateTextField.setText("");
                    //on fait les requete pour ajouté le livre et l'associé à un genre
                    String sqlAddBook = "INSERT INTO book (title , author, parution_date,image_url,description) VALUES(\"" +book+"\",\""+author+"\",\""+publicationDate+"\",\""+imageUrl+"\",\""+description+"\");";
                    connectionDatabase.insert(sqlAddBook,connect);
                    String sqlIdBook = "SELECT id FROM book  where title='"+book+"'AND author='"+author+"';";
                    String idBook = connectionDatabase.selectList(sqlIdBook, connect,"id").get(0);
                    String sqlIdGenre = "SELECT id FROM genre  where label='"+genre+"';";
                    String idGenre = connectionDatabase.selectList(sqlIdGenre, connect,"id").get(0);
                    String sqladdHasGenre = "INSERT INTO has_genre (id_book,id_genre) VALUES('"+idBook+"','"+idGenre+"');";
                    connectionDatabase.insert(sqladdHasGenre,connect);
                    //on réactualise la liste de livres
                    ArrayList<String> livres = connectionDatabase.selectList("SELECT title FROM book;",connect,"title");
                    bookListComboBox.removeAllItems();
                    for(String mot:livres) {
                        bookListComboBox.addItem(mot);
                    }
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer toutes les informations requises (titre, auteur, genre, description, image url et date de parution).", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        // permet de supprimer le livre sélectionné lors de l'appuie sur le bouton
        removeBookButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String selectedBook = (String) bookListComboBox.getSelectedItem();
                if (selectedBook != null) {
                    // Supprimez le livre sélectionné de vos données et mettez à jour le menu déroulant des livres
                    textArea.append("Livre supprimé: " + selectedBook + "\n");
                    String sqlIdBook = "SELECT id FROM book  where title=\""+selectedBook+"\";";
                    String idBook = connectionDatabase.selectList(sqlIdBook, connect,"id").get(0);
                    connectionDatabase.delete("DELETE FROM book WHERE title = \""+selectedBook+"\";",connect);
                    connectionDatabase.delete("DELETE FROM has_genre WHERE id_book = \""+idBook+"\";",connect);
                    //on réactualise la liste de livres
                    ArrayList<String> livres = connectionDatabase.selectList("SELECT title FROM book;",connect,"title");
                    bookListComboBox.removeAllItems();
                    for(String mot:livres) {
                        bookListComboBox.addItem(mot);
                    }

                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez sélectionner un livre valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        //panneau dans lequel s'affiche le résultat des actionListener
        JScrollPane scrollPane = new JScrollPane(textArea);
        bookPanel.add(scrollPane, BorderLayout.SOUTH);

        // Panel pour gérer les utilisateurs dans (créer un autre onglet)
        JPanel usersPanel = new JPanel();
        tabbedPane.addTab("Utilisateurs", usersPanel);

        //bouton et selecteur pour supprimer des utilisateurs
        JLabel userLabel = new JLabel("Nom d'utilisateur:");
        usersPanel.add(userLabel);
        ArrayList<String> users = connectionDatabase.selectList("SELECT user_name FROM user;",connect,"user_name");
        JComboBox userListComboBox = new JComboBox();
        for(String mot:users) {
            userListComboBox.addItem(mot);
        }
        usersPanel.add(userListComboBox);

        JButton removeUserButton = new JButton("Supprimer utilisateur");
        usersPanel.add(removeUserButton);

        //là ou s'affiche le résultat d'un appuie sur le bouton supprmimer un utilisateur
        JTextArea usersTextArea = new JTextArea(10, 50);
        usersTextArea.setEditable(false);
        JScrollPane usersScrollPane = new JScrollPane(usersTextArea);
        usersPanel.add(usersScrollPane, BorderLayout.SOUTH);

        //supprime un utilisateur quand on appuie sur le bouton prévu à cet effet
        removeUserButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String username = (String) userListComboBox.getSelectedItem();
                if (!username.isEmpty()) {
                    connectionDatabase.delete("DELETE FROM user WHERE user_name = '"+username+"';",connect);
                    usersTextArea.append("Utilisateur supprimé: " + username + "\n");
                    userListComboBox.removeAllItems();
                    ArrayList<String> users = connectionDatabase.selectList("SELECT user_name FROM user;",connect,"user_name");
                    for(String mot:users) {
                        userListComboBox.addItem(mot);
                    }


                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer un nom d'utilisateur valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        //panel pour supprimer les review (créer un autre onglet)
        JPanel removeReviewPanel = new JPanel();
        tabbedPane.addTab("Supprimer Avis", removeReviewPanel);

        //permet de choisir de quel livre vient la review
        JLabel bookRemoveLabel = new JLabel("Filtre");
        removeReviewPanel.add(bookRemoveLabel);
        ArrayList<String> book = connectionDatabase.selectList("SELECT title FROM book;",connect,"title");
        JComboBox bookRemoveListComboBox = new JComboBox();
        for(String mot:book) {
            bookRemoveListComboBox.addItem(mot);
        }
        removeReviewPanel.add(bookRemoveListComboBox);

        //affiches la liste des avis
        JLabel bookTitleLabel = new JLabel("Avis:");
        removeReviewPanel.add(bookTitleLabel);

        ArrayList<String[]> reviewContent = connectionDatabase.selectList3("SELECT review.content, user.user_name, book.title  FROM review JOIN user ON user.id=review.id_user JOIN book ON book.id=review.id_book;",connect,"content", "user_name","title");


        JComboBox reviewListComboBox = new JComboBox();
        for(String[] tab:reviewContent) {
            reviewListComboBox.addItem(tab[0]+" : "+tab[1]+" : "+tab[2]);
        }
        removeReviewPanel.add(reviewListComboBox);

        //permet de mettre à jour la liste des avis en fonction du livre choisi
        bookRemoveListComboBox.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                String bookChoosen = (String) bookRemoveListComboBox.getSelectedItem();
                reviewListComboBox.removeAllItems();
                ArrayList<String[]> reviewContent = connectionDatabase.selectList3("SELECT review.content, user.user_name, book.title  FROM review JOIN user ON user.id=review.id_user JOIN book ON book.id=review.id_book WHERE book.title=\""+bookChoosen+"\";",connect,"content", "user_name","title");
                for(String[] tab:reviewContent) {
                    reviewListComboBox.addItem(tab[0]+" : "+tab[1]+" : "+tab[2]);
                }
            }
        });

        // le bouton  pour supprimer les avis
        JButton removeReviewButton = new JButton("Supprimer Avis");
        removeReviewPanel.add(removeReviewButton);

        //les résultats des requetes pour supprimer les avis s'affichent ici
        JTextArea reviewsTextArea = new JTextArea(10, 50);
        reviewsTextArea.setEditable(false);
        JScrollPane reviewsScrollPane = new JScrollPane(reviewsTextArea);
        removeReviewPanel.add(reviewsScrollPane, BorderLayout.SOUTH);

        //supprimes l'avis quand on appuie sur le bouton
        removeReviewButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String bookReview = (String) reviewListComboBox.getSelectedItem();
                String[] bookReviewSeparated = bookReview.split(" : ");
                String bookTitle = bookReviewSeparated[2];
                String reviewerName  = bookReviewSeparated[1];

                System.out.println(bookReview);
                if (bookReview != null ) {

                    String sqlIdBook = "SELECT id FROM book  where title=\""+bookTitle+"\";";
                    String idBook = connectionDatabase.selectList(sqlIdBook, connect,"id").get(0);
                    String sqlIdUser = "SELECT id FROM user  where user_name=\""+reviewerName+"\";";
                    String idUser = connectionDatabase.selectList(sqlIdUser, connect,"id").get(0);
                    connectionDatabase.delete("DELETE FROM review where id_user='"+idUser+"' AND id_book='"+idBook+"';",connect);

                    reviewsTextArea.append("Avis supprimé pour le livre \"" + bookTitle + "\" de l'utilisateur \"" + reviewerName + "\"\n");
                    ArrayList<String> reviewContent = connectionDatabase.selectList("SELECT content FROM review;",connect,"content");
                    ArrayList<String> reviewUser = connectionDatabase.selectList("SELECT user_name FROM user where user.id=(SELECT id_user FROM review);",connect,"user_name");
                    ArrayList<String> reviewBook = connectionDatabase.selectList("SELECT title FROM book where book.id=(SELECT id_book FROM review);",connect,"title");
                    reviewListComboBox.removeAllItems();
                    for(int i = 0;i<reviewContent.size();i++) {
                        reviewListComboBox.addItem(reviewContent.get(i)+" : "+reviewUser.get(i)+" : "+reviewBook.get(i));
                    }

                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez sélectionner un livre et entrer un nom d'utilisateur valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        // Panel pour gérer les cercles (créer un autre onglet)
        JPanel circlesPanel = new JPanel();
        tabbedPane.addTab("Cercles", circlesPanel);

        //liste des cercles et bouton pour supprimer le cercle choisi
        JLabel circleLabel = new JLabel("Nom du cercle:");
        circlesPanel.add(circleLabel);
        ArrayList<String> circles = connectionDatabase.selectList("SELECT title FROM circle;",connect,"title");
        JComboBox circleListComboBox = new JComboBox();
        for(String mot:circles) {
            circleListComboBox.addItem(mot);
        }
        circlesPanel.add(circleListComboBox);

        JButton removeCircleButton = new JButton("Supprimer cercle");
        circlesPanel.add(removeCircleButton);

        JTextArea circlesTextArea = new JTextArea(10, 50);
        circlesTextArea.setEditable(false);
        JScrollPane circlesScrollPane = new JScrollPane(circlesTextArea);
        circlesPanel.add(circlesScrollPane, BorderLayout.SOUTH);

        //supprimes le cercle de la base de données
        removeCircleButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String circleName = (String) circleListComboBox.getSelectedItem();
                if (!circleName.isEmpty()) {
                    // Get the id of the circle
                    String sqlIdCircle = "SELECT id FROM circle WHERE title=\"" + circleName + "\";";
                    String idCircle = connectionDatabase.selectList(sqlIdCircle, connect, "id").get(0);

                    // Delete the users from the circle in the user_in_circle table
                    String sqlDeleteUsersInCircle = "DELETE FROM user_in_circle WHERE circle_id='" + idCircle + "';";
                    connectionDatabase.delete(sqlDeleteUsersInCircle, connect);

                    // Delete the circle from the circle table
                    String sqlDeleteCircle = "DELETE FROM circle WHERE id=\"" + idCircle + "\";";
                    connectionDatabase.delete(sqlDeleteCircle, connect);

                    circlesTextArea.append("Cercle supprimé: " + circleName + "\n");

                    //reactualise la liste de cercle
                    ArrayList<String> circles = connectionDatabase.selectList("SELECT title FROM circle;",connect,"title");
                    circleListComboBox.removeAllItems();
                    for(String mot:circles) {
                        circleListComboBox.addItem(mot);
                    }
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer un nom de cercle valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });


        frame.setVisible(true);
    }
}
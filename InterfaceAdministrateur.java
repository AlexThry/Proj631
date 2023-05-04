import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

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
        JFrame frame = new JFrame("Interface Administrateur");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(600, 400);

        Container contentPane = frame.getContentPane();
        contentPane.setLayout(new BorderLayout());

        JPanel mainPanel = new JPanel();
        mainPanel.setLayout(new GridLayout(2, 1));
        contentPane.add(mainPanel, BorderLayout.CENTER);

        // Panel pour ajouter un genre
        JPanel genrePanel = new JPanel();
        mainPanel.add(genrePanel);

        JLabel genreLabel = new JLabel("Ajouter un genre:");
        genrePanel.add(genreLabel);

        JTextField genreTextField = new JTextField(15);
        genrePanel.add(genreTextField);

        JButton addGenreButton = new JButton("Ajouter genre");
        genrePanel.add(addGenreButton);

        // Panel pour ajouter un livre
        JPanel bookPanel = new JPanel();
        mainPanel.add(bookPanel);

        JLabel bookLabel = new JLabel("Ajouter un livre:");
        bookPanel.add(bookLabel);

        JTextField bookTextField = new JTextField(15);
        bookPanel.add(bookTextField);

        JLabel bookGenreLabel = new JLabel("Genre:");
        bookPanel.add(bookGenreLabel);

        JTextField bookGenreTextField = new JTextField(15);
        bookPanel.add(bookGenreTextField);

        JButton addBookButton = new JButton("Ajouter livre");
        bookPanel.add(addBookButton);

        JTextArea textArea = new JTextArea(10, 50);
        textArea.setEditable(false);
        JScrollPane scrollPane = new JScrollPane(textArea);
        contentPane.add(scrollPane, BorderLayout.SOUTH);

        addGenreButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String genre = genreTextField.getText();
                if (!genre.isEmpty()) {
                    textArea.append("Genre ajouté: " + genre + "\n");
                    genreTextField.setText("");
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer un genre valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        addBookButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String book = bookTextField.getText();
                String genre = bookGenreTextField.getText();
                if (!book.isEmpty() && !genre.isEmpty()) {
                    textArea.append("Livre ajouté: " + book + " (Genre: " + genre + ")\n");
                    bookTextField.setText("");
                    bookGenreTextField.setText("");
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer un titre de livre et un genre valides.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        frame.setVisible(true);
    }
}
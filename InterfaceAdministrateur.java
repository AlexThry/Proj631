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
        frame.setSize(400, 200);

        Container contentPane = frame.getContentPane();
        contentPane.setLayout(new BorderLayout());

        JPanel genrePanel = new JPanel();
        contentPane.add(genrePanel, BorderLayout.CENTER);

        JLabel genreLabel = new JLabel("Ajouter un genre:");
        genrePanel.add(genreLabel);

        JTextField genreTextField = new JTextField(15);
        genrePanel.add(genreTextField);

        JButton addButton = new JButton("Ajouter");
        genrePanel.add(addButton);

        JTextArea textArea = new JTextArea(10, 30);
        textArea.setEditable(false);
        JScrollPane scrollPane = new JScrollPane(textArea);
        contentPane.add(scrollPane, BorderLayout.SOUTH);

        addButton.addActionListener(new ActionListener() {
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

        frame.setVisible(true);
    }
}

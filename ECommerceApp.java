import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import static java.lang.System.out;

class Transaction {
    private final int transactionId;
    private final String customerName;
    private final double totalAmount;
    private final Date transactionDate; // Tambahkan atribut transactionDate

    public Transaction(int transactionId, String customerName, Date transactionDate, double totalAmount) {
        this.transactionId = transactionId;
        this.customerName = customerName;
        this.transactionDate = transactionDate;
        this.totalAmount = totalAmount;
    }

    public int getTransactionId() {
        return transactionId;
    }

    public String getCustomerName() {
        return customerName;
    }

    public double getTotalAmount() {
        return totalAmount;
    }

    public Date getTransactionDate() {
        return transactionDate; // Implementasikan method untuk mengembalikan tanggal transaksi
    }
}

class TransactionManager {
    private final List<Transaction> transactions;

    public TransactionManager() {
        transactions = new ArrayList<>();
    }

    public void addTransaction(Transaction transaction) {
        transactions.add(transaction);
    }

    public double calculateTotalRevenue() {
        double totalRevenue = 0;
        for (Transaction transaction : transactions) {
            totalRevenue += transaction.getTotalAmount();
        }
        return totalRevenue;
    }

    public List<Transaction> findTransactionsByCustomerName(String customerName) {
        List<Transaction> result = new ArrayList<>();
        for (Transaction transaction : transactions) {
            if (transaction.getCustomerName().equalsIgnoreCase(customerName)) {
                result.add(transaction);
            }
        }
        return result;
    }
}

public class ECommerceApp {
    public static void main(String[] args) {
        TransactionManager transactionManager = new TransactionManager();

        // Menambahkan transaksi baru
        Transaction transaction1 = new Transaction(1, "Nisa", new Date(), 50.0);
        Transaction transaction2 = new Transaction(2, "Seni", new Date(), 75.0);
        transactionManager.addTransaction(transaction1);
        transactionManager.addTransaction(transaction2);

        // Menghitung total pendapatan dari transaksi
        double totalRevenue = transactionManager.calculateTotalRevenue();
        out.println("Total Revenue: $" + totalRevenue);

        // Mencari transaksi berdasarkan kriteria tertentu
        List<Transaction> transactionsByCustomerName = transactionManager.findTransactionsByCustomerName("Nisa");
        out.println("Transactions by customer name (Nisa):");
        for (Transaction transaction : transactionsByCustomerName) {
            printTransactionInfo(transaction);
        }
        transactionsByCustomerName = transactionManager.findTransactionsByCustomerName("Seni");
        out.println("Transactions by customer name (Seni):");
        for (Transaction transaction : transactionsByCustomerName) {
            printTransactionInfo(transaction);
        }

    }

    public static void printTransactionInfo(Transaction transaction) {
        SimpleDateFormat dateFormat = new SimpleDateFormat("dd-MM-yyyy HH:mm:ss");
        String formattedDate = dateFormat.format(transaction.getTransactionDate());
        out.println("Transaction ID: " + transaction.getTransactionId() + ", Customer: " + transaction.getCustomerName()
                + ", Amount: $" + transaction.getTotalAmount() + ", Date: " + formattedDate);
    }
}

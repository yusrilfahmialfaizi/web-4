package com.example.android.mutiarabaru;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Objects;

import static com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions.withCrossFade;

public class BarangViewAdapter extends RecyclerView.Adapter<BarangViewAdapter.ViewHolder> {

    private Context mContext;
    private ArrayList<HashMap<String, String>> mBarang;
	public static ArrayList<Cart_detail> productsArray = new ArrayList<Cart_detail>();
	public static ArrayList<Cart> cartModels = new ArrayList<Cart>();
	public static Cart cartModel;
	public static Cart_detail cartDetail;
    private SessionHandler sessionHandler;

    public BarangViewAdapter(ListBarang barang, ArrayList<HashMap<String,String>> mBarang) {
        this.mContext = barang;
        this.mBarang = mBarang;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.cardview_barang,null);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(final ViewHolder holder, final int position) {
        Glide.with(mContext)
                .load("http://192.168.43.70/mutiarabahari/upload/" + mBarang.get(position).get("gambar"))
                .transition(withCrossFade())
                .placeholder(R.mipmap.no_image)
                .into(holder.img_gambar_barang);
        holder.text_barang.setText(mBarang.get(position).get("nama_barang"));


		sessionHandler = new SessionHandler(mContext);
        User user = sessionHandler.getUserDetails();
        if (user.getStatus().equals("agen")){
			holder.harga.setText("Rp. "+mBarang.get(position).get("hrg_grosir1"));
		}else if(user.getStatus().equals("pelanggan biasa")){
			holder.harga.setText("Rp. "+mBarang.get(position).get("harga"));
		}
		holder.pesan.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {
				Toast.makeText(mContext,": " + mBarang.get(position).get("id_barang")+" : "+ holder.qty.getText(),Toast.LENGTH_LONG).show();
				String id_barang = mBarang.get(position).get("id_barang");
				sessionHandler = new SessionHandler(mContext.getApplicationContext());
				User user = sessionHandler.getUserDetails();
//				cartModel = new Cart();
//				cartModel.setId_user(user.getId_user());
//				cartModel.setJenis_pembayaran("Cash");
				cartDetail = new Cart_detail();
				cartDetail.setId_barang(mBarang.get(position).get("id_barang"));
				cartDetail.setNama_barang(mBarang.get(position).get("nama_barang"));
				cartDetail.setQty(Integer.valueOf(String.valueOf(holder.qty.getText())));
				cartDetail.setHarga(Integer.valueOf(mBarang.get(position).get("harga")));
//				cartDetail.setSub_total(100);
				productsArray.add(cartDetail);

//				Toast.makeText(mContext,productsArray.get(position).getNama_barang(),Toast.LENGTH_LONG).show();
				Intent i = new Intent(mContext, OrderActivity.class);
				mContext.startActivity(i);
			}
		});
    }
    private void addToCart(){

	}
    @Override
    public int getItemCount() {
        return mBarang.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder
    {

        TextView text_barang;
        TextView harga;
        EditText qty;
        Button pesan;
        ImageView img_gambar_barang;

        public ViewHolder(View itemView) {
            super(itemView);

            text_barang = (TextView) itemView.findViewById(R.id.barang);
            harga = (TextView) itemView.findViewById(R.id.harga);
            qty = (EditText) itemView.findViewById(R.id.qty);
            img_gambar_barang = (ImageView) itemView.findViewById(R.id.gambar_barang);
            pesan = (Button) itemView.findViewById(R.id.Pesan);


        }
    }

}
